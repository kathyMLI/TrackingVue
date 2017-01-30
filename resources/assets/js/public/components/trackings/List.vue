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
                        <router-link :to="{ name: 'trackingsCreate' }" class="button is-primary">Nuevo Paquete</router-link>
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
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><p class="control"><input v-model="search.code" v-on:blur="filter" type="text" class="input" placeholder="Codigo"></p></td>
                                        <td><p class="control"><input v-model="search.description" v-on:blur="filter" type="text" class="input" placeholder="Descripcion"></p></td>
                                        <td><p class="control"><input v-model="search.delivered" v-on:blur="filter" type="text" class="input" placeholder="Estado"></p></td>
                                        <td></td>
                                    </tr>
                                    <tr v-for="(track, index) in data.data">
                                        <td>{{ track.code }}</td>
                                        <td>{{ setString(track.pivot.description) }}</td>
                                        <td>{{ track.delivered}}</td>
                                        <td>
                                            <a class="button" @click="setModal(track)"><i class="fa fa-eye"></i></a>
                                            <router-link :to="{ name: 'trackingsEdit', params: { id: track.id} }" class="button"><span class="fa fa-pencil-square-o"></span></router-link>
                                            <a class="button is-danger" @click="destroy(track.id, index)"><span class="fa fa-trash"></span></a>
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
                                    <p class="modal-card-title">Codigo: {{ modal.data.code }}</p>
                                    <button class="delete" @click="modal.show = false, modal.current = 'description'"></button>
                                </header>
                                <section class="modal-card-body">
                                    <div class="tabs is-centered">
                                        <ul>
                                            <li @click="modal.current = 'description'" v-bind:class="{ 'is-active': modal.current == 'description'}">
                                                <a>Descripcion</a>
                                            </li>
                                            <li @click="modal.current = 'history'" v-bind:class="{ 'is-active': modal.current == 'history'}">
                                                <a>Historial</a>
                                            </li>
                                            <li @click="modal.current = 'delivered'" v-bind:class="{ 'is-active': modal.current == 'delivered'}" v-if="modal.data.delivered == 'Entregado'">
                                                <a>Entrega</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="modalDescription" v-if="modal.current == 'description'">
                                        {{ modal.data.pivot. description }}
                                    </div>
                                    <div class="modalHistory" v-if="modal.current == 'history'">
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
                                    <div class="modalDelivered" v-if="modal.current == 'delivered'">
                                        <b>Entregado a:</b> {{ modal.data.data.delivery_table.deliveredTo }}
                                        <br>
                                        <b>Rut:</b> {{ modal.data.data.delivery_table.deliveredToRut }}
                                        <br>
                                        <b>Fecha:</b> {{ modal.data.data.delivery_table.deliveredDate }}
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
                    current: 'description',
                    data: {
                        delivered: '',
                        pivot: {
                            description: ''
                        }
                    }
                }
            }
        },
        beforeMount() {
            resources.trackings()
                .then((data) => {
                    this.data.data = data.data.data;
                    this.data.totalItems = data.data.total;
                    this.data.itemsPerPage = data.data.per_page;
                    this.data.currentPage = data.data.current_page;
                    console.log(this.data.data);
                })
        },
        methods: {
            filter() {
                router.replace({query: {
                    page: this.search.page,
                    code: this.search.name,
                    description: this.search.email,
                    delivered: this.search.roles
                }});
                console.log('camibo');
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
                console.log(tracking);
            }
        }
    }
</script>