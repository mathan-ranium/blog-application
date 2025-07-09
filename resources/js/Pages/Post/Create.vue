<script setup >
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {
    ref, reactive, onMounted
} from 'vue'
import {
        router, usePage
} from '@inertiajs/vue3'
import { useToast } from "vue-toastification";
const toast = useToast();
const props = defineProps(['post'])
const page = usePage();

const form = reactive({
    title: props.post? props.post.title : '',
    content:  props.post? props.post.content : '',
});

const errors = ref([]);

const submit = () => {
   if (!props.post) {
        return router.post(route('post.store'), form, {
            onSuccess: (res) => {console.log(res)
                errors.value = [];
                form.title = '';
                form.content = '';
                toast.success('post saved successfully');
            },
            onError: (error) => {
                errors.value = error
                toast.error('Post not created');
            },
        });
   }
   else {
        return router.post(route('post.update', props.post.id), form, {
            onSuccess: (res) => {
                toast.success('post update successfully');
            },
            onError: (errors) => {
                toast.error('Post not created');
            },
        });
   }
};

</script>

<template>
<div class="max-w-5xl justify-center mx-auto my-24 ">
    <div class="bg-gray-50">
        <a :href="route('dashboard')">Back to posts</a>

        <div v-if="errors.title || errors.content" class="bg-red-100 p-4 rounded-md text-red-600" >
            <p v-if="errors.title">{{ errors.title }}</p>
            <p v-if="errors.content">{{ errors.content }}</p>
        </div>
        <form @submit.prevent="submit()">
            <h2 class="text-blue-600 font-bold py-4 text-xl">Create Post</h2>
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" id="title" v-model="form.title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John"  />


            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-10">Content</label>
            <textarea v-model="form.content" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
        
            <button type="submit" class="text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Default</button>
        </form>
    </div>
</div>
</template>
