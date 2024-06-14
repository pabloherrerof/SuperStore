"use client"
import axios from '@/lib/axios'
import { toastError, toastSuccess } from '@/lib/notifications'
import { act } from 'react'
import { create } from 'zustand'

export const useAnimationStore = create((set) => ({
    componentExit: {
        login: false,
        clients: false,
        profile: false,
      },
      setExit: (key) => set((state) => {
        return {
          componentExit: {
            ...state.componentExit, 
            [key]: true,
          },
        }
      }),
      resetExit: () => set(() => {
        return {
          componentExit: {
            login: false,
            clients: false,
            profile: false,
          },
        }
      }),
}))

export const useParamsStore = create((set) => ({
    params: {
        current_page: 0,
        total: 0,
        per_page: 10,
        search: "",
        bigger_than: "",
        smaller_than: "",
        category: "",
        active: null,
        total_pages: 0,
        url: "",
    },
    setParams: (key, value) => set((state) => {
        return {
          params: {
            ...state.params,
            [key]: value,
          },
        }
      }
    ),
    buildUrl: (params) => {
        let url = `/api/clients?page=${params.current_page}`;
        if (params.search) url += `&search=${params.search}`;
        if (params.bigger_than) url += `&bigger_than=${params.bigger_than}`;
        if (params.smaller_than) url += `&smaller_than=${params.smaller_than}`;
        if (params.category) url += `&category_id=${params.category}`;
        if (params.active !== null) url += `&active=${params.active}`;
        params.url = url;
        return url;
    },
    resetFilters: () => set(() => {
        return {
          params: {
            per_page: 10,
            search: "",
            bigger_than: "",
            smaller_than: "",
            category: "",
            active: null,
          },
        }
      }
    ),
}))

export const useCategoriesStore = create((set, get) => ({
    categories: [],

    setCategories: (categories) => set(() => {
        return {
          categories,
        }
      }
    ),
    fetchCategories: async () => {
      try {
        axios.defaults.withCredentials = true;
        const response = await axios.get(`/api/categories`);
        if (response.data.length === 0) {
          return;
        }
        set(() => {
          return {
            categories: response.data,
          }
        });
      } catch (error) {
        console.error(error);
        toastError("Error fetching categories");
      }
  },
    getCategoryName: (id) => get().categories.find((category) => category.id === id)?.name || "",
}))

export const useClientsStore = create((set) => ({
    clients: [],
    setClients: (clients) => set(() => {
        return {
          clients,
        }
      }
    ),
    createClient: async (clientData) => {
      const formData = new FormData();
      formData.append("name", clientData.name);
      formData.append("surname", clientData.surname);
      formData.append("email", clientData.email);
      formData.append("population", clientData.population);
      formData.append("category_id", clientData.category_id);
      formData.append("birthday", clientData.birthday);
      formData.append("active", clientData.active);
      formData.append("photo", clientData.photo);
      try {
        axios.defaults.withCredentials = true;
        await axios.post(`/api/clients`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });
        toastSuccess("Client added successfully.");
        return {ok: true}
      } catch (error) {
        toastError(error.response.data.message)
        
      }
    },

    editClient: async (client) => {
      const formData = new FormData();
      formData.append("name", client.name);
      formData.append("surname", client.surname);
      formData.append("email", client.email);
      formData.append("population", client.population);
      formData.append("category_id", client.category_id);
      formData.append("birthday", client.birthday);
      formData.append("active", client.active);
      formData.append("photo", client.photo);
      formData.append('_method', 'PUT')
      try {
        axios.defaults.withCredentials = true;
        await axios.post(`/api/clients/${client.id}`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });
        toastSuccess("Client updated successfully.");
        return {ok: true}
      } catch (error) {
        toastError(error.response.data.message)
      }
      },

      deleteClient: async (id) => {
        try {
          console.log("Hola")
          axios.defaults.withCredentials = true;
          await axios.delete(`/api/clients/${id}`);
          toastSuccess("Client deleted successfully.");
          return {ok: true}
        } catch (error) {
          toastError(error.response.data.message)
        }
      },

}))