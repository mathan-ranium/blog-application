<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { useToast } from "vue-toastification";

const props = defineProps(['posts']);

const deletePost = (post) => {
    alert('do you want delete this post?');
        router.delete(route('post.delete', post), {
            onSuccess: (res) => {
                useToast().success(res.props.flash.success);
            }
        })
    };

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900 flex">
                        <a :href="route('post.create')" class=" text-white bg-blue-500 rounded-md px-4 py-2">Create Post</a>
                    </div>
                    <div>                 

                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            created at
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="post in posts" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{post.title}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{post.created_at}}
                                        </td>
                                        <td class="px-6 py-4 space-x-2">
                                            <a :href="route('post.edit', post.id)">Edit</a>
                                            <a :href="route('post.show', post)">View</a>
                                            <button class="text-red-600" @click="deletePost(post)">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
