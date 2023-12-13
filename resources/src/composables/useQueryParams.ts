import { Ref, ref } from 'vue'

export const useQueryParams = () => {
  const pageSize: Ref<number> = ref<number>(40)
  const currentPage: Ref<number> = ref<number>(1)

  function setPage(page: number): void {
    currentPage.value = page
  }

  function addPagination(searchParams: URLSearchParams): void {
    searchParams.set('per_page', String(pageSize.value))
    searchParams.set('page', String(currentPage.value))
  }

  function addSearch(searchParams: URLSearchParams, key: string, value: string): void {
    searchParams.set(`filter[${key}]`, value)
  }

  function addSort(searchParams: URLSearchParams, value: string): void {
    searchParams.set('sort', value)
  }

  return {
    pageSize,
    currentPage,
    setPage,
    addPagination,
    addSearch,
    addSort,
  }
}
