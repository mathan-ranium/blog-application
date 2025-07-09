<script setup >
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, reactive } from 'vue';
import {
    router, usePage
} from '@inertiajs/vue3';
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps(['post', 'userType'])

const form = reactive({
    comment: '',
    username: '',
    email: '',
    post_id: props.post.id
});

const errors = ref([]);

const submit = () => {
    return router.post(route('comment.store'), form, {
        onSuccess: () => {
            toast.success('comment saved successfully');
        },
        onError: (error) => {
            errors.value = error;
            toast.error('Comment not posted');
        },
    });
};

</script>

<template>
<div class="max-w-5xl justify-center mx-auto my-24 ">
    <div class="bg-gray-50">
        <a :href="route('dashboard')">Back to posts</a>
      
        <div v-if="errors.username || errors.email || errors.comment" class="bg-red-100 p-4 rounded-md text-red-600" >
            <p v-if="errors.username">{{ errors.username }}</p>
            <p v-if="errors.email">{{ errors.email }}</p>
            <p v-if="errors.comment">{{ errors.comment }}</p>
        </div>

        <div class="bg-gray-100 shadow-sm my-10 px-4 rounded-md py-10">
            <h1> Title : {{ post.title }}</h1>
            <p>Created at: {{ post.created_at }}</p>

            <div>
                <h2>Post Content</h2>
                <p>{{ post.content }}</p>

            </div>
        </div>

        <div v-if="userType=='admin'">
            <h1>Comments</h1>
            <div class="px-4 space-y-4" v-for="comment in post.comments">
               <div class="border border-gray-600 rounded-lg p-2">
                <p class="text-md text-black font-bold">{{ comment.username}}</p>
                <p class="text-md text-black">{{ comment.comment }} (<span class="text-gray-400 text-sm">{{ comment.created_at }}</span>)</p>
               </div>
            </div>
        </div>
        <div v-else>
            <form @submit.prevent="submit()">
                <h2 class="text-blue-600 font-bold py-4 text-xl">Add comments</h2>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">user name</label>
                <input type="text" id="title" v-model="form.username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John"  />

                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
                <input type="text" id="title" v-model="form.email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John"  />

                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mt-10">Content</label>
                <textarea v-model="form.comment" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
            
                <button type="submit" class="text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Default</button>
            </form>
        </div>
    </div>
</div>
</template>
