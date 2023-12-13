<script setup lang="ts">
import { ref, reactive, watch } from 'vue';
import { useQueryParams } from '../composables/useQueryParams';
import { IPaginationData } from '../types/paginationCollection.types';
import { IProperty } from '../types/properties.types';
import axios, { AxiosResponse, AxiosError } from 'axios';
import { ElNotification } from 'element-plus';
import { ISearchFilters, defaultSearchFilters } from '../types/searchFilters.types';


const {
    pageSize,
    currentPage,
    setPage,
    addPagination,
    addSearch,
    addSort,
} = useQueryParams()

const properties = ref<IProperty[]>([])
const totalProperties = ref<number>(0)
const searchFilters = reactive<ISearchFilters>({...defaultSearchFilters})
const sortBy = ref<string>('')

const isPropertiesTableLoading = ref(false)


watch(searchFilters, () => {
  fetchProperties()
})

const fetchProperties = async () => {
  isPropertiesTableLoading.value = true

  const searchParams = new URLSearchParams('')
  addPagination(searchParams)

  Object.keys(searchFilters).forEach((key: string) => {
    if (searchFilters[key] === '') {
      return;
    }

    addSearch(searchParams, key, searchFilters[key])
  })

  // if (sortBy.value !== '') {
  //     addSort(searchParams, sortBy.value)
  // }

  try {
    await axios.get<IPaginationData<IProperty[]>>(import.meta.env.VITE_API_URL + '/properties?' + searchParams.toString())
      .then((response: AxiosResponse<IPaginationData<IProperty[]>>) => {
        properties.value = response.data.data
        totalProperties.value = response.data.meta.total
      })
  } catch (e: any) {
    if (e instanceof AxiosError) {
      ElNotification({
        title: 'Error',
        message: 'Failed to load data',
        type: 'error',
      })
    }
  } finally {
    isPropertiesTableLoading.value = false
  }
}

fetchProperties()

const resetFilters = () => {
  searchFilters.user_name = ''
}
</script>

<template>
  <div>
    <div>
      <el-row>
        <h1 class="text-xl">Filters</h1>
      </el-row>
      <el-row class="mt-3">
        <el-input
          v-model="searchFilters.user_name"
          placeholder="Name"
          clearable
          >
          <template #append>
            <el-button icon="Search" />
          </template>
        </el-input>
      </el-row>

      <el-row class="mt-3" :gutter=20>
        <span class="w-35 text-gray-600 inline-flex items-center ml-3">
          Price
        </span>
        <el-col :span="10">
          <el-input
            v-model="searchFilters.min_price"
            placeholder="Min price"
            type="number">
          </el-input>
        </el-col>
        <p>&mdash;</p>
        <el-col :span="10">
          <el-input
            v-model="searchFilters.max_price"
            placeholder="Max price"
            type="number">
          </el-input>
        </el-col>
      </el-row>

      <el-row class="mt-3">
        <el-col :span="5">
          <el-input
            v-model="searchFilters.bedrooms"
            placeholder="Bedrooms"
            type="number">
          </el-input>
        </el-col>
        <el-col :span="5" class="ml-3">
          <el-input
            v-model="searchFilters.bathrooms"
            placeholder="Bathrooms"
            type="number">
          </el-input>
        </el-col>
        <el-col :span="5" class="ml-3">
          <el-input
            v-model="searchFilters.storeys"
            placeholder="Storeys"
            type="number">
          </el-input>
        </el-col>
        <el-col :span="5" class="ml-3">
          <el-input
            v-model="searchFilters.garages"
            placeholder="Garages"
            type="number">
          </el-input>
        </el-col>
      </el-row>

      <el-button 
        class="mt-3" 
        type="info"
        @click="resetFilters()"
        >
        Reset filters
      </el-button>
    </div>
    

    <el-row>
        <h1 class="text-2xl mt-3">Properties</h1>
      </el-row>
    <el-table
      id="properties-table"
      class="mt-3"
      v-loading="isPropertiesTableLoading"
      empty-text="No properties for the specified filters"
      :data="properties"
      border
    >
      <el-table-column
          prop="user_name"
          label="User name"
          align="center" />
      <el-table-column
          prop="price"
          label="Price"
          align="center" />
      <el-table-column
          prop="bedrooms"
          label="Bedrooms"
          align="center" />
      <el-table-column
          prop="bathrooms"
          label="Bathrooms"
          align="center" />
      <el-table-column
          prop="storeys"
          label="Storeys"
          align="center" />
      <el-table-column
          prop="garages"
          label="Garages"
          align="center" />
    </el-table>
  </div>
</template>

<style scoped>
</style>
