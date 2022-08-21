<template>
    <FormHeader
        logo="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600"
    >
        <template v-slot:title> Sign up </template>
        <template v-slot:subTitle>
            <router-link
                :to="{ name: 'Login' }"
                class="font-medium text-indigo-600 hover:text-indigo-500"
            >
                Sign in
            </router-link>
        </template>
    </FormHeader>
    <form
        class="mt-8 space-y-6"
        @submit.prevent="register"
        action="#"
        method="POST"
    >
        <div class="rounded-md shadow-sm -space-y-px">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <label for="name" class="sr-only">name</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    autocomplete="name"
                    required
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="name"
                    v-model="user.name"
                />
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <label for="email-address" class="sr-only">Email address</label>
                <input
                    id="email-address"
                    name="email"
                    type="email"
                    autocomplete="email"
                    required
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Email address"
                    v-model="user.email"
                />
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <label for="password" class="sr-only">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="Password"
                    v-model="user.password"
                />
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <label for="password_confirmation" class="sr-only"
                    >Confirm password</label
                >
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="current-password_confirmation"
                    required
                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    placeholder="password confirmation"
                    v-model="user.password_confirmation"
                />
            </div>
        </div>
        <FormButton type="submit">Sing up</FormButton>
    </form>
</template>

<script setup>
import store from "@/store";
import { useRouter } from "vue-router";
/* components */
import FormHeader from "@/components/FormHeader.vue";
import FormButton from "@/components/FormButton.vue";
/* !components */
import { reactive, ref } from "@vue/reactivity";
const user = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const router = useRouter();

function register() {
    store
        .dispatch("register", user)
        .then((res) => res)
        .then((res) => {
            router.push({ name: "Home" });
        })
        .catch((err) => {
            console.log(err);
        });
}
</script>

<style scoped></style>
