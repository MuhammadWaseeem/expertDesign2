<template>
    <div class="con-vs-pagination vs-pagination-primary">
    <nav  aria-label="pagination" class="vs-pagination--nav">
        <ul class="pagination vs-pagination--ul">

            <!--            <li class="page-item"><a class="page-link" @click.prevent="changePage(1)" :disabled="pagination.current_page <= 1">First page</a></li>-->
<!--            <li class="page-item item-pagination vs-pagination&#45;&#45;li"><span class="page-link" @click.prevent="changePage(pagination.current_page - 1)" :disabled="pagination.current_page <= 1">Previous</span></li>-->
            <li v-for="page in pages" class="page-item item-pagination vs-pagination--li">
                <span class="page-link" :class="isCurrentPage(page) ? 'is-current' : ''" @click.prevent="changePage(page)">{{ page }}</span>
            </li>
<!--            <li class="page-item item-pagination vs-pagination&#45;&#45;li"><span class="page-link" @click.prevent="changePage(pagination.current_page + 1)" :disabled="pagination.current_page >= pagination.last_page">Next page</span></li>-->
            <!--            <li class="page-item"><a class="page-link" @click.prevent="changePage(pagination.last_page)" :disabled="pagination.current_page >= pagination.last_page">Last page</a></li>-->
        </ul>
    </nav>
    </div>
</template>

<style>
    .actlink{
        background-color: #c1c1c1 !important;
    }
    .pagination{
        float:right;

    }
    .page-item{
        padding: 0px !important;
    }
</style>

<script>
    export default {
        props: ['pagination', 'offset'],
        methods: {
            isCurrentPage(page) {
                return this.pagination.current_page === page;
            },
            changePage(page) {
                if (page > this.pagination.last_page) {
                    page = this.pagination.last_page;
                }
                this.pagination.current_page = page;
                this.$emit('paginate');
            }
        },
        computed: {
            pages() {
                let pages = [];
                let from = this.pagination.current_page - Math.floor(this.offset / 2);
                if (from < 1) {
                    from = 1;
                }
                let to = from + this.offset - 1;
                if (to > this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                while (from <= to) {
                    pages.push(from);
                    from++;
                }
                return pages;
            }
        }
    }
</script>
