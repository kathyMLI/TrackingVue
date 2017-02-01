<template>
    <div>
        <div>
            <h1 class="title">Listado Anuncios</h1>
            <hr>
        </div>
        <div class="">
            <div class="">
                <div class="">
                    <div class="pull-right">
                        <router-link :to="{ name: 'announcementCreate' }" class="button is-primary">Nuevo Anuncio</router-link>
                    </div>
                </div>
            </div>
            <div class="row">
                <article class="col-md-12">
                    <div id="announcement-table">
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Titulo</th>
                                        <th>Mensaje</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(ann, index) in data.data">
                                        <td>{{ ann.title }}</td>
                                        <td>{{ setString(ann.message) }}</td>
                                        <td>
                                            <a class="button"><span class="fa fa-pencil-square-o"></span></a>
                                            <a class="button is-danger" @click="destroy(ann.id, index)"><span class="fa fa-trash"></span></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                    title: '',
                    message: '',
                    page: ''
                },
                resource: 'announcements'
            }
        },
        methods: {
            filter() {
                router.replace({query: {
                    page: this.search.page,
                    title: this.search.title,
                    message: this.search.message
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
                return msg.substr(0,50) + '...';
            },
        }
    }
</script>