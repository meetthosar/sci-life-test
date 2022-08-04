<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3'
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
                    <Link :href="route('leads.upload')" class="btn-indigo">
                        <span>Import</span></Link>
                </div>

                <div class="bg-white rounded-md shadow overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <tr class="text-left font-bold">
                            <th class="px-6 pt-6 pb-4">Name</th>
                            <th class="px-6 pt-6 pb-4">Email</th>
                            <th colspan="2" class="px-6 pt-6 pb-4">Active</th>
                        </tr>
                        <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t"><a href="https://demo.inertiajs.com/organizations/70/edit"
                                                    class="px-6 py-4 flex items-center focus:text-indigo-500">
                                Altenwerth and Sons
                                <!----></a></td>
                            <td class="border-t"><a tabindex="-1"
                                                    href="https://demo.inertiajs.com/organizations/70/edit"
                                                    class="px-6 py-4 flex items-center">
                                Marianneside
                            </a></td>
                            <td class="border-t"><a tabindex="-1"
                                                    href="https://demo.inertiajs.com/organizations/70/edit"
                                                    class="px-6 py-4 flex items-center">
                                800-893-0529
                            </a></td>
                            <td class="border-t w-px"><a tabindex="-1"
                                                         href="https://demo.inertiajs.com/organizations/70/edit"
                                                         class="px-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                     class="block w-6 h-6 fill-gray-400">
                                    <polygon
                                        points="12.95 10.707 13.657 10 8 4.343 6.586 5.757 10.828 10 6.586 14.243 8 15.657 12.95 10.707"></polygon>
                                </svg>
                            </a></td>
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
