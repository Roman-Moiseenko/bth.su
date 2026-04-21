import {ref, watch} from "vue";

export type Product = {

    id: number
    name: string
    description: string
    price: number,
    category: string,
    trashed: boolean
}

export function getProducts(page: number, category_id: any) {

    // @ts-ignore
    const url = import.meta.env.VITE_API_BASE_URL

    const products = ref<Product[]>([])
    const pages = ref(1)
    const loaded = ref(false)

    reloadProducts(page, category_id)

    function reloadProducts(page: number, category_id: any) {
        loaded.value = true
        let params = new URLSearchParams({
            page: page.toString()
        })
        if (category_id !== null && category_id != undefined) params['category_id'] = category_id.toString()
        fetch(`${url}/products?${params.toString()}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
        }).then(response => {
            if (!response.ok) {
                throw new Error(`Ошибка HTTP: ${response.status}`);
            }
            return response.json();
        }).then(results => {
            products.value = [...results.data]
            pages.value = results.total
            loaded.value = false
        });
    }

    return {
        products,
        pages,
        loaded,
        reloadProducts
    }
}
