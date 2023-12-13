export interface ISearchFilters {
    user_name: string;
    bedrooms: string;
    bathrooms: string;
    storeys: string;
    garages: string;
    min_price: string;
    max_price: string;
}
  
export const defaultSearchFilters: ISearchFilters = {
    user_name: '',
    bedrooms: '',
    bathrooms: '',
    storeys: '',
    garages: '',
    min_price: '',
    max_price: '',
};