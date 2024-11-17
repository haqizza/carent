<script setup>
import CarTable from '@/Components/CarTable.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    cars: {
        type: [{
            number_plate: String,
            model: String,
            trademark: String,
            production_year: Number,
            rent_price: Number,
            available: String
        }]
    }
})
</script>

<template>
    <Head title="Car Return" />

    <AuthenticatedLayout headTitle="Car Management">

        <div class="py-12">
            <div class="mx-auto max-w-7xl px-8 py-4 sm:px-6 lg:px-8 bg-white shadow-sm rounded-lg">
                <div class="flex justify-end my-4 px-3 py-2 border border-slate-300 rounded xl">
                    <Link :href="route('return.add')" class="px-3 py-2 bg-blue-400 hover:bg-blue-300 text-white font-semibold rounded-lg cursor-pointer">
                        Return
                    </Link>
                </div>
                <h2 class="my-4 text-center text-xl font-semibold  leading-tight text-gray-800">
                    Rent History
                </h2>
                <CarTable :cars="cars"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
