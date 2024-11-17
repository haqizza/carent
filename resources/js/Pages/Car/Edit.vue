<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    car: {
        type: {
            number_plate: String,
            model: String,
            trademark: String,
            production_year: Number,
            rent_price: Number,
            available: Number
        }
    },
    edit: {
        type: Boolean
    }
})

const form = useForm({
    id: props.car.id || null,
    number_plate: props.car.number_plate || '',
    model: props.car.model || '',
    trademark: props.car.trademark || '',
    production_year: props.car.production_year || '',
    rent_price: props.car.rent_price || '',
    available: props.car.available == 1 ? true : false
});

const submit = () => {
    form.post(route('car.store'), {
        onFinish: () => route('car.view'),
    });
};


</script>

<template>
    <Head title="Car Management" />

    <AuthenticatedLayout headTitle="Car Management">

        <div class="py-12">
            <div class="mx-auto max-w-7xl px-8 py-4 sm:px-6 lg:px-8 bg-white shadow-sm rounded-lg">
                <div class="flex justify-end my-4">
                    <Link :href="route('car.view')" class="px-3 py-2 bg-red-400 hover:bg-red-300 text-white font-semibold rounded-lg cursor-pointer">
                        Cancel
                    </Link>
                </div>
                <div class="w-1/2 m-auto">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="number_plate" value="Number Plate" />

                            <TextInput
                                id="number_plate"
                                type="text"
                                class="mt-1 p-2 block w-full border border-slate-200"
                                v-model="form.number_plate"
                                placeholder="Z XXXX APA"
                                required
                                autofocus
                                autocomplete="number_plate"
                            />

                            <InputError class="mt-2" :message="form.errors.number_plate" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="model" value="Model" />

                            <TextInput
                                id="model"
                                type="text"
                                class="mt-1 p-2 block w-full border border-slate-200"
                                v-model="form.model"
                                placeholder="Camry"
                                required
                                autocomplete="model"
                            />

                            <InputError class="mt-2" :message="form.errors.model" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="trademark" value="Trademark" />

                            <TextInput
                                id="trademark"
                                type="text"
                                class="mt-1 p-2 block w-full border border-slate-200"
                                v-model="form.trademark"
                                placeholder="Mitsubishi"
                                required
                                autocomplete="trademark"
                            />

                            <InputError class="mt-2" :message="form.errors.trademark" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="production_year" value="Production Year" />

                            <TextInput
                                id="production_year"
                                type="number"
                                class="mt-1 p-2 block w-full border border-slate-200"
                                v-model="form.production_year"
                                placeholder="2000"
                                required
                                autocomplete="production_year"
                            />

                            <InputError class="mt-2" :message="form.errors.production_year" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="rent_price" value="Daily Rent Price" />

                            <TextInput
                                id="rent_price"
                                type="number"
                                class="mt-1 p-2 block w-full border border-slate-200"
                                v-model="form.rent_price"
                                placeholder="1000000"
                                required
                                autocomplete="rent_price"
                            />

                            <InputError class="mt-2" :message="form.errors.rent_price" />
                        </div>

                        <div class="mt-4">
                            <div class="w-full flex gap-4 items-center">
                                <InputLabel for="available" value="Avalability" />

                                <Checkbox
                                    id="available"
                                    class="p-3 block"
                                    v-model:checked="form.available"
                                />
                            </div>

                            <InputError class="mt-2" :message="form.errors.available" />
                        </div>

                        <div class="mt-4 ">
                            <button
                                class="w-full px-3 py-2 bg-green-500 hover:bg-green-400 text-white text-center font-semibold rounded-lg cursor-pointer"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                {{edit ? 'Save' : 'Add'}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
