<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    categories : Array
})
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold text-center">
                            <td class="px-6 pt-6 pb-4">name</td>
                            <td class="px-6 pt-6 pb-4">parent</td>
                            <td class="px-6 pt-6 pb-4">level</td>
                            <td class="px-6 pt-6 pb-4">order_sequence</td>
                        </tr>
                        <tr class="hover:bg-gray-100 focus-within:bg-gray-100 text-center" v-for="category in categories">
                            <td class="border-t">{{ category.name }}</td>
                            <td class="border-t">{{ category.parent }}</td>
                            <td class="border-t">{{ category.level }}</td>
                            <td class="border-t">{{ category.order_sequence }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
