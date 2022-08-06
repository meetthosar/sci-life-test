<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
    leads : Object
})
</script>

<template>
    <AppLayout title="Leads">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Leads
            </h2>
        </template>

        <div scroll-region="" class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto">
            <div><!----> <!----></div>
            <div>
                <div class="mb-6 flex justify-between items-center">
                    <Link :href="route('leads.upload')" class="finline-flex items-center px-4 py-2
                            bg-gray-800 border border-transparent rounded-md font-semibold text-xs
                            text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900
                            focus:outline-none focus:border-gray-900 focus:ring
                            focus:ring-gray-300 disabled:opacity-25 transition">
                        <span>Import</span></Link>
                </div>

                <div class="bg-white rounded-md shadow overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold">
                            <th class="px-6 pt-6 pb-4">Name</th>
                            <th class="px-6 pt-6 pb-4">Email</th>
                            <th class="px-6 pt-6 pb-4">Active</th>
                        </tr>
                        <tr v-for="lead in leads" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t">{{ lead.first_name }}{{ lead.last_name }}</td>
                            <td class="border-t">{{ lead.email }}</td>
                            <td class="border-t">{{ lead.active }}</td>

                        </tr>
                    </table>
                </div>

                <div class="mt-6">
                    <div class="flex flex-wrap -mb-1"></div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
