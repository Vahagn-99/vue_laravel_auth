<template>
    <FormHeader
        logo="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600"
    >
        <template v-slot:title> Sign in </template>
        <template v-slot:subTitle>
            <router-link
                :to="{ name: 'Registration' }"
                class="font-medium text-indigo-600 hover:text-indigo-500"
            >
                Sign up
            </router-link>
        </template>
    </FormHeader>
    <form
        class="mt-8 space-y-6"
        @submit.prevent="login"
        action="#"
        method="POST"
    >
        <div class="rounded-md shadow-sm -space-y-px">
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
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input
                        id="remember-me"
                        name="remember"
                        type="checkbox"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                        v-model="user.remember"
                    />
                    <label
                        for="remember-me"
                        class="ml-2 block text-sm text-gray-900"
                    >
                        Remember me
                    </label>
                </div>

                <div class="text-sm">
                    <a
                        href="#"
                        class="font-medium text-indigo-600 hover:text-indigo-500"
                    >
                        Forgot your password?
                    </a>
                </div>
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
    email: "",
    password: "",
    remember: false,
});

const router = useRouter();

function login() {
    // console.log(user);
    store
        .dispatch("login", user)
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
