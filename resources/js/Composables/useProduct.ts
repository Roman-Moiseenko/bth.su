import {reactive, ref} from "vue";
import {FormRules} from "element-plus";
import {useAuthStore} from "../Stores/auth";

export type FormProduct = {
    name: string,
    description: string,
    price: number,
    category_id: number,
}

export function useProduct() {
    // @ts-ignore
    const url = import.meta.env.VITE_API_BASE_URL

    const auth = useAuthStore()
    const getInitialFormState = () => (<FormProduct>{
        name: null,
        description: null,
        price: null,
        category_id: null,
    });
    const rulesForm = reactive<FormRules<FormProduct>>({
        name: [
            {required: true, message: 'Укажите название товара', trigger: 'blur'},
        ],
        price: [
            {required: true, message: 'Укажите цену, целое число', trigger: 'blur'},
            { type: 'number', min: 10, message: 'Целое число не менее 10' }
        ],
        category_id: [
            {required: true, message: 'Выберите категорию', trigger: 'blur'},
        ],
    })
    async function create(data: FormProduct) {
        const id = ref(null);
        await fetch(`${url}/products`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${auth.token}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        }).then(response => {
            if (!response.ok) {
                throw new Error(`Ошибка HTTP: ${response.status}`);
            }
            return response.json();
        }).then(results => {
            // @ts-ignore
            if (Number.isInteger(results)) {
                id.value = results
            } else {
                throw new Error('Товар не создан');
            }
        });
        return id.value;
    }


    async function update(id: number, data: FormProduct) {
        await fetch(`${url}/products/${id}`, {
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${auth.token}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        }).then(response => {
            if (!response.ok) {
                throw new Error(`Ошибка HTTP: ${response.status}`);
            }
            return response.json();
        }).then(results => {

        });
        return "success"
    }
    async function remove(id: number) {
        await fetch(`${url}/products/${id}`, {
            method: 'DELETE',
            headers: {
                'Authorization': `Bearer ${auth.token}`,
                'Accept': 'application/json',
            },
        }).then(response => {
            if (!response.ok) {
                throw new Error(`Ошибка HTTP: ${response.status}`);
            }
            return response.json();
        }).then(results => {

        });
        return "success"
    }
    return {
        getInitialFormState,
        rulesForm,
        create,
        update,
        remove,
    }
}

