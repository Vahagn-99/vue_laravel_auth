<template>
    <div class="min-h-full">
        <Navigation :current="name"></Navigation>
        <Header :title="name"></Header>
        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <!-- Replace with your content -->
                <div class="px-4 py-6 sm:px-0">
                    <router-view></router-view>
                </div>
                <!-- /End replace -->
            </div>
        </main>
    </div>
</template>

<script setup>
import { useRoute } from "vue-router";
import { computed, onMounted, ref } from "vue";
import store from "@/store";

import Header from "@/components/Header.vue";
import Navigation from "@/components/Navigation.vue";

const router = useRoute();

const name = computed(() => router.name);

</script>
