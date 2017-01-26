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
                                    <tr v-for="(track, index) in me.trackings">
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
                                    <p class="modal-card-title">{{ modal.data.code }}</p>
                                    <button class="delete" @click="modal.show = false"></button>
                                </header>
                                <section class="modal-card-body">
                                    {{ modal.data.pivot.description }}
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
    import trackingService from '../../services/trackingService'
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
                me: {},
                modal: {
                    show: false,
                    data: {
                        pivot: {
                            description: ''
                        }
                    }
                }
            }
        },
        beforeMount() {
            Event.listen('me', (msg) => { this.me = msg});
        },
        methods: {
            filter() {
                router.replace({query: {
                    page: this.search.page,
                    code: this.search.name,
                    description: this.search.email,
                    delivered: this.search.roles
                }});
                resources.filterResources(this.resource, router.currentRoute.query)
                    .then((data) => {
                        this.data.data = data.data.data;
                        this.data.totalItems = data.data.total;
                        this.data.itemsPerPage = data.data.per_page;
                        this.data.currentPage = data.data.current_page;
                    });
            },
            setString(msg) {
                return msg.substr(27) + '...';
            },
            prueba() {
                console.log('algo');
            },
            setModal(tracking) {
                this.modal.data = tracking;
                this.modal.show = true;
            }
        }
    }
</script>