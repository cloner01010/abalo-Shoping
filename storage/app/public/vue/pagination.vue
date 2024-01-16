<template>
    <div class="pagination">
        <ul class="pagination-list">
            <li v-if="pagination.current_page > 1" @click="changePage(1)">&laquo;</li>
            <li v-if="pagination.current_page > 1" @click="changePage(pagination.current_page - 1)">&lt;</li>

            <li v-for="page in pages" :key="page" :class="{ active: page === pagination.current_page }" @click="changePage(page)">
                {{ page }}
            </li>

            <li v-if="pagination.current_page < pagination.last_page" @click="changePage(pagination.current_page + 1)">&gt;</li>
            <li v-if="pagination.current_page < pagination.last_page" @click="changePage(pagination.last_page)">&raquo;</li>
        </ul>
    </div>
</template>

<script>
export default {
    emits: ['page-change'],
    props: {
        pagination: {
            type: Object,
            required: true,
        },
    },
    computed: {
        pages() {
            const from = Math.max(1, this.pagination.current_page - 2);
            const to = Math.min(this.pagination.last_page, this.pagination.current_page + 2);
            const pagesArray = [];

            for (let page = from; page <= to; page++) {
                pagesArray.push(page);
            }

            return pagesArray;
        },
    },
    methods: {
        changePage(page) {
            this.$emit('page-change', {search:"",page:page});
        },
    },
};
</script>

<style>
.pagination {
    margin-bottom: 20px;
}

.pagination-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination-list li {
    display: inline-block;
    padding: 5px 10px;
    background-color: #e5dada;
    margin-right: 5px;
    cursor: pointer;
}

.pagination-list li.active {
    background-color: #565353;
}
</style>

