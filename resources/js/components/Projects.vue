<template>
    <div class="container mt-5">
        <div class="col-md-12">
            <h3>پروژه ها</h3>

            <div class="projects">
                <div class="row">
                    <div class="tableFilters col-md-6">
                        <input class="input" type="text" v-model="tableData.search" placeholder="جستجو در موضوع"
                               @input="getProjects">

                        <div class="control">
                            <div class="select">
                                <select v-model="tableData.length" @change="getProjects">
                                    <option v-for="(records, index) in perPage" :key="index" :value="records">{{ records }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <pagination :data="projects" @pagination-change-page="getProjects"></pagination>
                    </div>
                </div>

                <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
                    <tbody>
                    <tr v-for="project in projects.data" :key="project.id">
                        <td><router-link :to="'/project/' + project.slug">{{ project.title }}</router-link></td>
                        <td>{{ project.budget }}</td>
                        <td>{{ project.created_at }}</td>
                    </tr>
                    </tbody>
                </datatable>
            </div>
        </div>
    </div>
</template>

<script>
    import Datatable from './TableComponents/DataTable.vue';

    export default {
        name: "Projects",

        components: { datatable: Datatable },

        created() {
            this.getProjects();
        },
        data() {
            let sortOrders = {};
            let columns = [
                {width: '33%', label: 'موضوع', name: 'title' },
                {width: '33%', label: 'بودجه', name: 'budget'},
                {width: '33%', label: 'زمان ساخت', name: 'created_at'}
            ];
            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });
            return {
                projects: {},
                columns: columns,
                sortKey: 'title',
                sortOrders: sortOrders,
                perPage: ['10', '20', '30'],
                tableData: {
                    draw: 0,
                    length: 10,
                    search: '',
                    column: 0,
                    dir: 'desc',
                },
            }
        },

        mounted() {
            this.$root.$on('searching', () => {
                this.tableData.search = this.$parent.search;
                this.getProjects();
            });
        },

        methods: {
            getProjects(page = 1, url = '/api/project') {
                url = url + `?page=${page}`;
                this.tableData.draw++;
                axios.get(url, {params: this.tableData})
                    .then(( response ) => {
                        let data = response.data;
                        if (this.tableData.draw == data.draw) {
                            this.projects = data.data;
                        }
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
                this.tableData.column = this.getIndex(this.columns, 'name', key);
                this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
                this.getProjects();
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] == value)
            },
        }
    }
</script>

<style scoped>

</style>