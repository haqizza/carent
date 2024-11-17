<script setup>
import { Link } from '@inertiajs/vue3';
import DeleteIcon from './Icons/DeleteIcon.vue';
import EditIcon from './Icons/EditIcon.vue';

defineProps({
    cars: [{
            number_plate: String,
            model: String,
            trademark: String,
            production_year: Number,
            rent_price: Number,
            available: Number
    }]
})
const rupiah = Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR'
})
</script>

<template>
    <table class="table w-full border border-slate-300/50 rounded-lg">
        <thead class="border-b border-slate-300/50 rounded-lg">
            <tr>
                <th class="py-4">No</th>
                <th class="py-4">Number Plate</th>
                <th class="py-4">Model</th>
                <th class="py-4">Trademark</th>
                <th class="py-4">Production</th>
                <th class="py-4">Daily Rent Price</th>
                <th class="py-4">Availability</th>
                <th class="py-4" v-if="$page.props.auth.user.role == 'admin'">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(car, index) in cars" class="text-center">
                <td class="py-4">{{ index + 1 }}</td>
                <td class="py-4">{{ car.number_plate }}</td>
                <td class="py-4">{{ car.model }}</td>
                <td class="py-4">{{ car.trademark }}</td>
                <td class="py-4">{{ car.production_year }}</td>
                <td class="py-4">{{ rupiah.format(car.rent_price) }}</td>
                <td class="py-4 flex justify-center">
                    <div
                    class="w-14 h-6"
                    :class="{
                        'bg-green-400': car.available == 1,
                        'bg-red-400': car.available == 0,
                    }"
                    >

                    </div>
                </td>
                <td class="py-4" v-if="$page.props.auth.user.role == 'admin'">
                    <div>
                        <div class="flex justify-center gap-4">
                            <Link
                                :href="route('car.edit')"
                                method="post"
                                :data="{
                                    id: car.id
                                }"
                            >
                                <EditIcon />
                            </Link>
                            <Link
                                :href="route('car.delete')"
                                method="delete"
                                :data="{
                                    number_plate: car.number_plate
                                }"
                            >
                                <DeleteIcon />
                            </Link>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
