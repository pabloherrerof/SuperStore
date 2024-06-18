import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import PrimaryButton from '@/Components/PrimaryButton';
import { toastError, toastSuccess } from '@/Lib/notifications';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';

export default function EditProduct({ auth, product, categories }) {
    const { data, setData, put, errors } = useForm({
        name: product.name || '',
        price: product.price || '',
      category_ids: product.category.map(category => category.id) || [], 
        description: product.description || '',
        image_url: product.image || '',
    });

    console.log(product)
    const handleSubmit = (e) => {
        e.preventDefault();
        put(route('products.update', product.id));
    };

    const handleCategoryChange = (e) => {
        const categoryId = parseInt(e.target.value);
        const isChecked = e.target.checked;
        let updatedCategories = [...data.category_ids];

        if (isChecked) {
            updatedCategories.push(categoryId);
        } else {
            updatedCategories = updatedCategories.filter(id => id !== categoryId);
        }

        setData('category_ids', updatedCategories);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-white leading-tight">Edit Product</h2>}
        >
            <Head title="Edit Product" />

            <div className="py-12 flex justify-center">
                <form onSubmit={handleSubmit} className="w-full max-w-lg bg-gray-800 p-6 rounded-lg shadow-md">
                    <div className="mb-4">
                        <InputLabel forInput="name" value="Product Name" className='text-black' />
                        <TextInput
                            id="name"
                            type="text"
                            value={data.name}
                            className="mt-1 block w-full"
                            isFocused={true}
                            onChange={(e) => setData('name', e.target.value)}
                        />
                        {errors.name && <div className="text-red-600 mt-2">{errors.name}</div>}
                    </div>

                    <div className="mb-4">
                        <InputLabel forInput="price" value="Price" />
                        <TextInput
                            id="price"
                            type="text"
                            value={data.price}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('price', e.target.value)}
                        />
                        {errors.price && <div className="text-red-600 mt-2">{errors.price}</div>}
                    </div>

                    <div className="mb-4">
                        <InputLabel forInput="category_ids" value="Categories" />
                        <div className="mt-2">
                            {categories.map((category) => (
                                <label key={category.id} className="flex items-center">
                                    <input
                                        type="checkbox"
                                        value={category.id}
                                        checked={data.category_ids.includes(category.id)} 
                                        onChange={handleCategoryChange}
                                    />
                                    <span className="ml-2 text-white">{category.name}</span>
                                </label>
                            ))}
                        </div>
                        {errors.category_ids && <div className="text-red-600 mt-2">{errors.category_ids}</div>}
                    </div>

                    <div className="mb-4">
                        <InputLabel forInput="description" value="Description" />
                        <TextInput
                            id="description"
                            value={data.description}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('description', e.target.value)}
                        />
                        {errors.description && <div className="text-red-600 mt-2">{errors.description}</div>}
                    </div>

                    <div className="mb-4">
                        <InputLabel forInput="image_url" value="Image URL" />
                        <TextInput
                            id="image_url"
                            type="text"
                            value={data.image_url}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('image_url', e.target.value)}
                        />
                        {errors.image_url && <div className="text-red-600 mt-2">{errors.image_url}</div>}
                    </div>

                    <div className="flex justify-end">
                        <PrimaryButton className="ml-4">Update Product</PrimaryButton>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
