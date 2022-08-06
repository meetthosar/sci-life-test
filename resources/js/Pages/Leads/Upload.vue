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

Echo.private(`validation.${usePage().props.value.user.id}`)
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

                            <button class="finline-flex items-center px-4 py-2
                            bg-gray-800 border border-transparent rounded-md font-semibold text-xs
                            text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900
                            focus:outline-none focus:border-gray-900 focus:ring
                            focus:ring-gray-300 disabled:opacity-25 transition" type="submit">Upload Leads</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
