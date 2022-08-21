<template>
    <ProductCard>
        <template v-slot:title>
            <!-- content for the header slot -->
            Customers also purchased
        </template>
        <ProductItem
            class="group relative"
            v-for="product in products"
            :key="product.id"
            :product="product"
        ></ProductItem>
    </ProductCard>
</template>

<script setup>
import { useStore } from "vuex";
import { onMounted, computed } from "vue";
const store = useStore();
/* components */
import ProductItem from "@/components/ProductItem.vue";
import ProductCard from "@/components/ProductCard.vue";
/* !components */

const products = computed(() => store.getters.getProducts);
onMounted(() => store.dispatch("fetchProducts"));
</script>
