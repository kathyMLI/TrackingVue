import resources from '../services/resources'
import confirm from '../helpers/confirm'
export default {
    beforeMount() {
        resources.getResources(this.resource)
            .then((data) => {
                this.data.data = data.data.data;
                this.data.totalItems = data.data.total;
                this.data.itemsPerPage = data.data.per_page;
                this.data.currentPage = data.data.current_page;
                console.log('papapap', this.data.data);
            });
    },this
    methods: {
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
        changePage(value) {
            this.search.page = value;
            this.filter()
        },
        removeFromData(index) {
            this.data.data.splice(index, 1);
        }
    }
}