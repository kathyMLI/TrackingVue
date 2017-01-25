<template>
    <div>
        <v-aside :show.sync="show" placement="right" header="Noticias" @close="close()">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" @click="changeVisible('notifications')">Notificaciones <span class="badge">{{sizeNotifications}}</span></button>
                <button type="button" class="btn btn-default" @click="changeVisible('announcements')">Anuncios <span class="badge">{{sizeAnnouncement}}</span></button>
            </div>
            <div class="panel panel-default" v-if="visible != ''">
                <div class="panel-body" v-if="visible == 'notifications'">
                    <div v-if="notifications">
                        <ul class="list-unstyled">
                            <li v-for="(not, index) in notifications">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a><i v-bind:class="not.data.icon"></i></a>
                                    </div>
                                    <div class="media-body">
                                        <div class="col-md-12">
                                                <b>{{ not.data.title}}</b>
                                                <span class="label label-primary" v-if="!not.read_at">New</span>
                                                <a class="pull-right" @click="destroy(not, index)">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                </a>
                                        </div>  
                                        {{ subStr(not.data.message) }}
                                        <a class="pull-right btn btn-primary btn-xs" @click="read(not)">Ver mas</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body" v-if="visible == 'announcements'">
                    <div v-if="announcements">
                        <ul class="list-unstyled">
                            <li v-for="(ann, index) in announcements">
                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a><i v-bind:class="ann.data.icon"></i></a>
                                    </div>
                                    <div class="media-body">
                                        <div class="col-md-12">
                                                <b>{{ ann.data.title}}</b>
                                                <span class="label label-primary" v-if="!ann.read_at">New</span>
                                                <a class="pull-right" @click="destroy(ann, index)">
                                                    <i class="glyphicon glyphicon-remove"></i>
                                                </a> 
                                        </div>  
                                        {{ subStr(ann.data.message) }}
                                        <a class="pull-right btn btn-primary btn-xs" @click="read(ann)">Ver mas</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </v-aside>
    </div>
</template>
<script>
    import notificationService from '../../services/notificationService'
    import { default as swal } from 'sweetalert2'
    export default {
        props: {
            show: {
                type: Boolean,
                default: false,
                required: true
            },
            news: {
                type: Array,
                default: () => { return []}
            }
        },
        data() {
            return {
                visible: '',
            }
        },
        computed: {
            sizeNotifications: function() {
                return _.filter(this.notifications, (n) => {
                    return !n.read_at
                }).length;
            },
            sizeAnnouncement: function() {
                return _.filter(this.announcements, (n) => {
                    return !n.read_at
                }).length;
            },
            announcements: function() {
                return _.filter(this.news, (n) => {
                    return n.data.type == 'announcement';
                });
            },
            notifications: function() {
                return _.filter(this.news, (n) => {
                    return n.data.type == 'notification';
                });
            }
        },
        methods: {
            close() {
                this.visible = '';
                this.$emit('close');
            },
            changeVisible(value) {
                this.visible = value;
            },
            read(element) {
                swal({
                    title: element.data.title,
                    html: element.data.message,
                    showCloseButton: true
                });
                notificationService.markAsRead({id: element.id})
                    .then((data) => {
                        element.read_at = true;
                    });
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
                            if(element.data.type == 'notification') {
                                this.notifications.splice(index, 1);
                            } else {
                                this.announcements.splice(index, 1);
                            }
                            swal(
                                'Eliminado!',
                                'El registro ha sido eliminado.',
                                'success'
                            );
                            this.close();
                        })
                });
            },
            subStr(str) {
                return str.substr(0, 80) + '...';
            }
        }
    }
</script>