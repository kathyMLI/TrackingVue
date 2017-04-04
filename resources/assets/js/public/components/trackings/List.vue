<template>
    <div>
        <div>
            <h1 class="title">Listado de Paquetes</h1>
            <hr>
        </div>
        <div class="">
            <div class="">
                <div class="">
                    <div class="pull-right">
                        <router-link :to="{ name: 'trackingsCreate' }" class="button">Nuevo Paquete</router-link>
                    </div>
                </div>
            </div>
            <div class="">
                <article class="">
                    <div id="users-table">
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Código</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th>Estado Legible</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td><p class="control"><input v-model="search.code" v-on:blur="filter" type="text" class="input" placeholder="Buscar Código"></p></td>
                                        <td><p class="control"><input v-model="search.description" v-on:blur="filter" type="text" class="input" placeholder="Buscar Descripción"></p></td>
                                        <td><p><input class="input" type="text" placeholder="Buscar Estado"></p></td>
                                        <td><p class="control"><input v-model="search.delivered" v-on:blur="filter" type="text" class="input is-100" placeholder="Buscar Estado Legible"></p></td>
                                        <td></td>
                                    </tr>
                                    <tr v-for="(track, index) in data.data">
                                        <td><img class="postal-platform-logo" :src="'img/postalPlatforms/' + track.postal_platform.label + '.png'"></td>
                                        <td>{{ track.code }}</td>
                                        <td>{{ setString(track.pivot.description) }}</td>
                                        <td>{{ getSendingStatus(track.history[0]) }}</td>
                                        <td><span v-bind:class="['tag', {'is-success': (track.delivered == 'Entregado'), 'is-primary': (track.delivered == 'En camino')}]">{{ track.delivered}}</span></td>
                                        <td>
                                            <a class="button is-small" @click="setModal(track)"><i class="fa fa-eye"></i></a>
                                            <router-link :to="{ name: 'trackingsEdit', params: { id: track.id} }" class="button is-small"><span class="fa fa-pencil-square-o"></span></router-link>
                                            <a class="button is-danger is-small" @click="destroy(track.id, index)"><span class="fa fa-trash"></span></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <!-- <el-pagination layout="prev, pager, next" :total="data.totalItems" :page-size="data.itemsPerPage" :current-page="data.currentpage" @current-change="changePage"></el-pagination> -->
                        </div>
                        <div class="modal" v-bind:class="{ 'is-active': modal.show }">
                            <div class="modal-background"></div>
                            <div class="modal-card">
                                <header class="modal-card-head">
                                    <p class="modal-card-title">{{ modal.data.pivot.description }} ({{ modal.data.code }})</p>
                                    <button class="delete" @click="modal.show = false, modal.current = 'description'"></button>
                                </header>
                                <section class="modal-card-body">
                                    <div class="modalHistory">
                                        <h2 class="tittle">Historial</h2>
                                        <hr>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Oficina</th>
                                                    <th>Estado</th>
                                                    <th>Fecha</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="ar in modal.data.history">
                                                    <th>{{ ar.sendingOffice }}</th>
                                                    <th>{{ ar.sendingStatus }}</th>
                                                    <th>{{ ar.sendingDate }}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modalDelivered" v-if="modal.data.data.delivery_table.deliveredTo">
                                        <h2 class="tittle">Entrega</h2>
                                        <hr>
                                        <b>Entregado a:</b> {{ modal.data.data.delivery_table.deliveredTo }}
                                        <br>
                                        <b v-if="modal.data.data.delivery_table.deliveredToRut">Rut:</b> {{ modal.data.data.delivery_table.deliveredToRut }}
                                        <br>
                                        <b v-if="modal.data.data.delivery_table.deliveredDate">Fecha:</b> {{ modal.data.data.delivery_table.deliveredDate }}
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</template>

<script>
    import resources from '../../services/resources'
    import router from '../../routes'
    import list from '../../mixins/list'
    import confirm from '../../helpers/confirm'
    export default {
        data() {
            return {
                data: {
                    data: [],
                    totalItems: 0,
                    itemsPerPage: 0,
                    currentPage: 0                    
                },
                search: {
                    code: '',
                    description: '',
                    delivered: ''
                },
                modal: {
                    show: false,
                    data: {
                        delivered: '',
                        pivot: {
                            description: ''
                        },
                        data : {
                            delivery_table: {

                            }
                        }
                    }
                },
                resource: 'trackings'
            }
        },
        beforeMount() {
            resources.trackings()
                .then((data) => {
                    this.data.data = data.data.data;
                    this.data.totalItems = data.data.total;
                    this.data.itemsPerPage = data.data.per_page;
                    this.data.currentPage = data.data.current_page;
                    console.log(this.data);
                })
        },
        methods: {
            filter() {
                router.replace({query: {
                    page: this.search.page,
                    code: this.search.code,
                    description: this.search.description,
                    delivered: this.search.delivered
                }});
                resources.filterTrackings(router.currentRoute.query)
                    .then((data) => {
                        this.data.data = data.data.data;
                        this.data.totalItems = data.data.total;
                        this.data.itemsPerPage = data.data.per_page;
                        this.data.currentPage = data.data.current_page;
                    });
            },
            setString(msg) {
                return msg.substr(0, 27) + '...';
            },
            setModal(tracking) {
                this.modal.data = tracking;
                this.modal.show = true;
            },
            getSendingStatus(history_data) {
                if(history_data) {
                    return history_data.sendingStatus;
                }
                return 'SIN INFORMACION';
            },
            delete(id, index) {
                resources.deleteResource(this.resource , id)
                    .then((data) => {
                        console.log('Eliminado');
                        this.removeFromData(index);
                    })
                    .catch((data) => {
                        console.log('Error!', data)
                    })
            },
            destroy(id, index) {
                confirm.destroy(id, index, this.delete);
            },
            removeFromData(index) {
                this.data.data.splice(index, 1);
            }
        }
    }
</script>