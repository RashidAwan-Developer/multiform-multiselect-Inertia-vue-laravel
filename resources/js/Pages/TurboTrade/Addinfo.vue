<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import {defineComponent, ref} from 'vue'
import Multiselect from '@vueform/multiselect'


const props = defineProps({
    errors: Object,

})

const form = useForm({
    vin: null,
    body: '',
    username: '',
    address: '',
    options: [
        { value: 'batman', label: 'Batman' },
        { value: 'robin', label: 'Robin' },
        { value: 'joker', label: 'Joker' },
    ]
});

const formStep = ref(1)

function nextStep()
{
    form.post( route("firstStep"), {
        onSuccess: () => {
            formStep.value++
        }
    });
}

function prevStep()
{
    formStep.value--
}

const submit = () => {
    form.post( route("store"), {
        onSuccess: () =>{
            form.reset(), (formStep.value == 1);
        }
    });
};

const submitTest = () => {
        form.post( route("test"));
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Information
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form>
                            <div v-if="formStep == 1">
                                <div>
                                    <InputLabel for="vin" value="vin" />
                                    <Multiselect
                                        v-model="form.vin"
                                        mode="tags"
                                        :close-on-select="false"
                                        :searchable="true"
                                        :create-option="true"
                                        :options="form.options"
                                    />
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="body" value="Information" />
                                    <TextInput id="body" type="text" class="mt-1 block w-full" v-model="form.body" />
                                    <InputError class="mt-2" :message="props.errors.body" />
                                </div>
                            </div>

                            <div v-if="formStep == 2">
                                <div class="mt-4">
                                    <InputLabel for="username" value="User Name" />
                                    <TextInput id="username" type="text" class="mt-1 block w-full" v-model="form.username"/>
                                    <InputError class="mt-2" :message="props.errors.username" />
                                </div>

                                <div class="mt-4">
                                    <InputLabel for="address" value="Address" />
                                    <TextInput id="address" type="text" class="mt-1 block w-full" v-model="form.address"/>
                                    <InputError class="mt-2" :message="props.errors.address" />
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton class="ml-4" v-if="formStep == 1" type="button" @click="nextStep"> Next </PrimaryButton>
                                <PrimaryButton class="ml-4" v-if="formStep == 2" type="button" @click="prevStep"> Prev </PrimaryButton>
                                <PrimaryButton class="ml-4" v-if="formStep == 2" @click="submit"> Create </PrimaryButton>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>


<style src="@vueform/multiselect/themes/default.css"></style>
