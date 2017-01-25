<template>
    <div>
        <div class="heading">
            <h1 class="title">Listado Anuncios</h1>
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
                                        <th>Icono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(ann, index) in data">
                                        <td>{{ ann.data.title }}</td>
                                        <td>{{ subStr(ann.data.message) }}</td>
                                        <td><i v-bind:class="ann.data.icon"></i></td>
                                        <td>
                                            <a class="button"><span class="fa fa-pencil-square-o"></span></a>
                                            <a class="button is-danger" @click="destroy(ann, index)"><span class="fa fa-trash"></span></a>
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
    import notificationService from '../../services/notificationService'
    import { default as swal } from 'sweetalert2'
    export default {
        data() {
            return {
                news: [],
                search: {
                    title: '',
                    message: ''
                }
            }
        },
        computed: {
            data: function() {
                return _.filter(this.news, (n) => {
                    return n.data.type == 'announcement';
                });
            }
        },
        beforeMount() {
            notificationService.getAnnouncement()
                .then(({data}) => {
                    this.news = data;
                    console.log(this.news)
                });
        },
        methods: {
            subStr(str) {
                return str.substr(0, 40) + '...';
            },
            destroy(element, index) {
                swal({
                    title: 'Esta seguro de eliminar?',
                    text: 'No sera capaz de recuperar el registro!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Si, eliminalo!',
                }).then(() => {
                    notificationService.delete({id: element.id, _method: 'delete'})
                        .then((data) => {
                            this.data.splice(index, 1);
                            swal(
                                'Eliminado!',
                                'El registro ha sido eliminado.',
                                'success'
                            );
                            this.close();
                        })
                });
            },
        }
    }
</script>