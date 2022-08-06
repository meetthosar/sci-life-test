<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3'
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia'

defineProps({
    errors : Object,
    upload_file : String,
    erroredRecords : Number,
    rowNumber : Number,
    totalRows : Number,
    previousRecords : Number,
    newRecords: Number,
    hideProceedButton : false
});

const form = useForm({
    upload_file : usePage().props.value.upload_file,
    erroredRecords : usePage().props.value.erroredRecords,
    totalRows : usePage().props.value.totalRows,
})


function submit() {
    form.post(`/leads/proceed`)
}

Echo.private(`import.${usePage().props.value.user.id}`)
    .listen('NotifyRecordImportStatus', (e) => {
        usePage().props.value.hideProceedButton = true
        usePage().props.value.rowNumber = e.rowNumber
        usePage().props.value.totalRows = e.totalRows
        usePage().props.value.previousRecords = e.previousRecords
        usePage().props.value.newRecords = e.newRecords
    });


</script>

<template>
    <AppLayout title="Leads">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Upload Leads
            </h2>
        </template>

        <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto" scroll-region="">
            <div>
                <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
                    <form  @submit.prevent="submit">
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <div class="pr-6 pb-8 w-full lg:w-1/2">
                                <input type="hidden" v-model="form.upload_file"/>
                                {{ upload_file }}
                            </div>
                        </div>
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <input type="hidden" v-model="form.erroredRecords"/>
                            <p>Total errored Rows : {{ erroredRecords }}</p>
                        </div>
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <input type="hidden" v-model="totalRows"/>
                            <p>Total Rows : {{ totalRows }}</p>
                        </div>
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <p>Importing Row number : {{ rowNumber }}</p>
                        </div>
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <p>Previous Rows : {{ previousRecords }}</p>
                        </div>
                        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                            <p>New Total Rows : {{ newRecords }}</p>
                        </div>
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                            <button v-if="!hideProceedButton"  class="finline-flex items-center px-4 py-2
                            bg-green-800 border border-transparent rounded-md font-semibold text-xs
                            text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900
                            focus:outline-none focus:border-green-900 focus:ring
                            focus:ring-green-300 disabled:opacity-25 transition"  type="submit">Proceed and Import</button>

                            <a :href="route('leads.index')">Abort</a>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
