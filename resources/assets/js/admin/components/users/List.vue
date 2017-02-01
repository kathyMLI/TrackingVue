<template>
    <div>
        <div>
            <h1 class="title">Listado de Usuarios</h1>
            <hr>
        </div>
        <div>
            <div class="">
                <div class="">
                    <div class="pull-right">
                        <router-link :to="{ name: 'usersCreate' }" class="button is-primary">Nuevo Usuario</router-link>
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
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Rut</th>
                                        <th>Roles</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><p class="control"><input v-model="search.name" v-on:blur="filter" type="text" class="input" placeholder="nombre"></p></td>
                                        <td><p class="control"><input v-model="search.email" v-on:blur="filter" type="text" class="input" placeholder="email"></p></td>
                                        <td><p class="control"><input v-rut v-model="auxRut" v-on:blur="filter" type="text" class="input" placeholder="rut"></p></td>
                                        <td><p class="control"><input v-model="search.roles" v-on:blur="filter" type="text" class="input" placeholder="rol"></p></td>
                                        <td></td>
                                    </tr>
                                    <tr v-for="(user, index) in data.data">
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ user.rut | rut }}</td>
                                        <td>
                                            <span v-for="role in user.roles">
                                                <span class="tag is-primary">{{ role.label }}</span>
                                            </span>
                                        </td>
                                        <td>
                                            <router-link :to="{ name: 'usersEdit', params: { id: user.id} }" class="button"><span class="fa fa-pencil-square-o"></span></router-link>
                                            <a class="button is-danger" @click="destroy(user.id, index)"><span class="fa fa-trash"></span></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <!-- <el-pagination layout="prev, pager, next" :total="data.totalItems" :page-size="data.itemsPerPage" :current-page="data.currentpage" @current-change="changePage"></el-pagination> -->
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
        mixins: [list],
        data() {
            return {
                data: {
                    data: [],
                    totalItems: 0,
                    itemsPerPage: 0,
                    currentPage: 0                    
                },
                search: {
                    name: '',
                    email: '',
                    rut: '',
                    roles: '',
                    page: ''
                },
                auxRut: '',
                resource: 'users'
            }
        },
        methods: {
            filter() {
                this.search.rut = this.auxRut;

                router.replace({query: {
                    page: this.search.page,
                    name: this.search.name,
                    email: this.search.email,
                    rut: this.search.rut,
                    roles: this.search.roles
                }});
                resources.filterResources(this.resource, router.currentRoute.query)
                    .then((data) => {
                        this.data.data = data.data.data;
                        this.data.totalItems = data.data.total;
                        this.data.itemsPerPage = data.data.per_page;
                        this.data.currentPage = data.data.current_page;
                    });
            }
        }
    }
</script>