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
    <Head title="Car Management" />

    <AuthenticatedLayout headTitle="Car Management">

        <div class="py-12">
            <div class="mx-auto max-w-7xl px-8 py-4 sm:px-6 lg:px-8 bg-white shadow-sm rounded-lg">
                <div class="flex justify-end my-4">
                    <Link :href="route('car.add')" class="px-3 py-2 bg-blue-400 hover:bg-blue-300 text-white font-semibold rounded-lg cursor-pointer">
                        Add Car
                    </Link>
                </div>
                <CarTable :cars="cars"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
