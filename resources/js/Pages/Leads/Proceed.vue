<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/inertia-vue3'
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia'

defineProps({
    errors : Object,
    upload_file : String,
    erroredRecords : Number
});

const form = useForm({
    upload_file : usePage().props.value.upload_file,
})


function submit() {
    form.post(`/leads/proceed`)
}

Echo.private(`import.1`)
    .listen('NotifyRecordImportStatus', (e) => {
        console.log(e);
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
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                            <button class="flex items-center btn-indigo" type="submit">Proceed and Import</button>
                        </div>
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
<!--                            <Link :href="/leads">Abort</Link>-->
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
