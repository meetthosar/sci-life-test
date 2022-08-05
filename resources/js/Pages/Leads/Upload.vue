<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
// import { Link } from '@inertiajs/inertia-vue3'
import {useForm, usePage} from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia'

defineProps({
    errors : Object,
    showProceedBox : Boolean,
});


const form = useForm({
    upload_file : null,
})


function submit() {
    form.post(`/leads/import`)
}

Echo.private(`validation.1`)
    .listen('NotifyRecordValidationStatus', (e) => {
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
                                <label class="form-label" for="text-input-38">Select File:</label>
                                <input class="form-input" type="file" @input="form.upload_file = $event.target.files[0]">
                                <div v-if="errors.upload_file">{{ errors.upload_file }}</div>
                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>

                            </div>
                        </div>
                        <div v-if="!showProceedBox" class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">

                            <button class="flex items-center btn-indigo" type="submit">Upload Leads</button>
                        </div>
                        <div  v-if="showProceedBox" class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                            <input type="hidden" :value="form.proceed">
                            <button class="flex items-center btn-indigo" type="submit">Proceed and Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
