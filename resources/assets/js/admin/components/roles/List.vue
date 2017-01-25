<template>
    <div>
        <div>
            <h1 class="title">Listado Roles</h1>
            <hr>
        </div>
        <div class="">
            <div class="">
                <div class="">
                    <div class="pull-right">
                        <router-link :to="{ name: 'rolesCreate' }" class="button is-primary">Nuevo Rol</router-link>
                    </div>
                </div>
            </div>
            <div class="">
                <article class="">
                    <div id="roles-table">
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Nombre publico o legible</th>
                                        <th>Permisos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><p class="control"><input v-model="search.name" v-on:blur="filter" type="text" class="input" placeholder="nombre"></p></td>
                                        <td><p class="control"><input v-model="search.label" v-on:blur="filter" type="text" class="input" placeholder="label"></p></td>
                                        <td><p class="control"><input v-model="search.roles" v-on:blur="filter" type="text" class="input" placeholder="permiso"></p></td>
                                        <td></td>
                                    </tr>
                                    <tr v-for="(rol, index) in data.data">
                                        <td>{{ rol.name }}</td>
                                        <td>{{ rol.label }}</td>
                                        <td>
                                            <span v-for="permission in rol.permissions">
                                                <span class="tag is-primary" data-badge-caption="">{{ permission.label }}</span>
                                            </span>
                                        </td>
                                        <td>
                                            <router-link :to="{ name: 'rolesEdit', params: { id: rol.id} }" class="button"><span class="fa fa-pencil-square-o"></span></router-link>
                                            <a class="button is-danger" @click="destroy(rol.id, index)"><span class="fa fa-trash"></span></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <el-pagination layout="prev, pager, next" :total="data.totalItems" :page-size="data.itemsPerPage" :current-page="data.currentpage" @current-change="changePage"></el-pagination>
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
    import confirm from '../../helpers/confirm'
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
                    label: '',
                    permissions: ''
                },
                resource: 'roles'
            }
        },
        methods: {
            filter() {
                router.replace({query: {
                    page: this.roles.currentPage,
                    name: this.search.name,
                    label: this.search.label,
                    permissions: this.search.permissions
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