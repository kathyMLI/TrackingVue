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
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- <td><p class="control"><input v-model="search.name" v-on:blur="filter" type="text" class="input" placeholder="nombre"></p></td>
                                        <td><p class="control"><input v-model="search.email" v-on:blur="filter" type="text" class="input" placeholder="email"></p></td>
                                        <td><p class="control"><input v-model="search.roles" v-on:blur="filter" type="text" class="input" placeholder="rol"></p></td>
                                        <td></td> -->
                                    </tr>
                                    <tr>
                                        <td><!-- {{ user.name }} --></td>
                                        <td><!-- {{ user.email }} --></td>
                                        <td>
                                            <!-- <span v-for="role in user.roles">
                                                <span class="tag is-primary">{{ role.label }}</span>
                                            </span> -->
                                        </td>
                                        <td>
                                            <!-- <router-link :to="{ name: 'trackingsEdit', params: { id: tracking.id} }" class="button"><span class="fa fa-pencil-square-o"></span></router-link>
                                            <a class="button is-danger" @click="destroy(user.id, index)"><span class="fa fa-trash"></span></a> -->
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
    export default {
        mounted() {

        }
    }
</script>