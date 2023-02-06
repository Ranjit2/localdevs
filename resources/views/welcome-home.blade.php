@extends('layouts.app')

@section('content')

<template>
    <div>
        load data...
    </div>
</template>
@endsection

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";


const users = ref([]);


const nextPageUrl = ref('');

const getTopics = (query) => {
    let url = nextPageUrl.value? nextPageUrl.value : 'filter/talents'
        axios.post('http://app.test/filter/talents?page=1', { filters: query })
            .then((response) => {
                users.value = response.data.data;
                nextPageUrl.value = response.data.next_page_url
            console.log('name:',response.data)
            //console.log('nextUrl', nextPageUrl.value)
                isLoading.value = false
        });
}


onMounted(() => {
   

})


