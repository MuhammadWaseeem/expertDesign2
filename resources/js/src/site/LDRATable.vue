<template>
    <vx-card title="History" >
        <vs-table multiple v-model="selected" search :data="columns">

            <template slot="thead">
                <vs-th sort-key="email">Assessment Date</vs-th>
                <vs-th sort-key="username">Carried Out By</vs-th>
                <vs-th sort-key="website">Property Address</vs-th>
                <vs-th sort-key="website">Property Type</vs-th>
                <vs-th sort-key="id">Any tenant</vs-th>
                <vs-th sort-key="id">Action</vs-th>
            </template>

            <template slot-scope="{data}">
                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">

                    <vs-td :data="data[indextr].assessment_date">
                        {{data[indextr].assessment_date}}
                    </vs-td>

                    <vs-td :data="data[indextr].carried_by">
                        {{data[indextr].carried_by}}
                    </vs-td>

                    <vs-td :data="data[indextr].property_address">
                        {{data[indextr].property_address}}
                    </vs-td>

                    <vs-td :data="data[indextr].property_type">
                        {{data[indextr].property_type}}
                    </vs-td>

                    <vs-td :data="data[indextr].any_tenant">
                        {{data[indextr].any_tenant}}
                    </vs-td>

                    <vs-td :data="data[indextr].assessment_id ">
                        <vs-button color="success" type="gradient" icon-pack="feather" icon="icon-eye" :href="'http://certificate.scotlanz.com?risk-assessment='+JSON.stringify(data[indextr])" ></vs-button>
                        <vs-button color="danger" type="gradient" icon-pack="feather" icon="icon-edit" @click="$router.push('/risk-assessment/edit/'+data[indextr].assessment_id)"></vs-button>
                    </vs-td>

                </vs-tr>
            </template>
        </vs-table>
        <pagination :offset="5" :pagination="pagination" @paginate="table()"  />
<!--        v-show="pagination.last_page > 1"-->
    </vx-card>
</template>

<script>
    import Prism from 'vue-prism-component';
    import Pagination from './CPagination'
    export default {
        data () {
            return {
                'selected': [],
                'tableList': [
                    'vs-th: Component',
                    'vs-tr: Component',
                    'vs-td: Component',
                    'thread: Slot',
                    'tbody: Slot',
                    'header: Slot'
                ],
                'users': [
                    {
                        'id': 1,
                        'name': 'Leanne Graham',
                        'username': 'Bret',
                        'email': 'Sincere@april.biz',
                        'website': 'hildegard.org'
                    },
                    {
                        'id': 2,
                        'name': 'Ervin Howell',
                        'username': 'Antonette',
                        'email': 'Shanna@melissa.tv',
                        'website': 'anastasia.net'
                    },
                    {
                        'id': 3,
                        'name': 'Clementine Bauch',
                        'username': 'Samantha',
                        'email': 'Nathan@yesenia.net',
                        'website': 'ramiro.info'
                    },
                    {
                        'id': 4,
                        'name': 'Patricia Lebsack',
                        'username': 'Karianne',
                        'email': 'Julianne.OConner@kory.org',
                        'website': 'kale.biz'
                    },
                    {
                        'id': 5,
                        'name': 'Chelsey Dietrich',
                        'username': 'Kamren',
                        'email': 'Lucio_Hettinger@annie.ca',
                        'website': 'demarco.info'
                    },
                    {
                        'id': 6,
                        'name': 'Mrs. Dennis Schulist',
                        'username': 'Leopoldo_Corkery',
                        'email': 'Karley_Dach@jasper.info',
                        'website': 'ola.org'
                    },
                    {
                        'id': 7,
                        'name': 'Kurtis Weissnat',
                        'username': 'Elwyn.Skiles',
                        'email': 'Telly.Hoeger@billy.biz',
                        'website': 'elvis.io'
                    },
                    {
                        'id': 8,
                        'name': 'Nicholas Runolfsdottir V',
                        'username': 'Maxime_Nienow',
                        'email': 'Sherwood@rosamond.me',
                        'website': 'jacynthe.com'
                    },
                    {
                        'id': 9,
                        'name': 'Glenna Reichert',
                        'username': 'Delphine',
                        'email': 'Chaim_McDermott@dana.io',
                        'website': 'conrad.com'
                    },
                    {
                        'id': 10,
                        'name': 'Clementina DuBuque',
                        'username': 'Moriah.Stanton',
                        'email': 'Rey.Padberg@karina.biz',
                        'website': 'ambrose.net'
                    }
                ],
                pagination: {'current_page': 1},
                columns:{},
                search_data:''
            }
        },
        methods:{
            table() {
                this.$http.get('/risk-assessment/create?page=' + this.pagination.current_page + '&q=' + this.search_data)
                    .then(response => {
                        this.columns = response.data.data.data;
                        this.pagination = response.data.pagination;
                    })
                    .catch(error => {
                    });
            },
        },
        components: {
            Prism,
            Pagination
        },
        created() {
            this.table();
        }
    }
</script>
