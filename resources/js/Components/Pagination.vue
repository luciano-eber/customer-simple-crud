<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    data: Object
})

const paginator = computed(() => {
    return props.data
})

const links = computed(() => {
    return props.data.links.slice(1, -1)
})


</script>

<template>
    <div>
        <nav aria-label="...">
            <ul class="pagination">
                
                <li class="page-item" :class="{ disabled: !paginator.prev_page_url }">
                    <Link class="page-link" :href="paginator.prev_page_url" >Previous</Link>
                </li>

                <li class="page-item" v-for="(link,l) in links" :key="l" :class="{ active: link.active }">
                    <Link class="page-link" :href="link.url">{{ link.label }}</Link>
                </li>

                <li class="page-item" :class="{ disabled: !paginator.next_page_url }">
                    <Link class="page-link" :href="paginator.next_page_url">Next</Link>
                </li> 
            </ul>
        </nav>
    </div>
</template>

<style lang="scss">
@import "bootstrap/scss/pagination";
ul {
    margin-bottom: 0;
}
</style>