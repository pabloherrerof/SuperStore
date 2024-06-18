import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import PrimaryButton from '@/Components/PrimaryButton';
import { toastError, toastSuccess } from '@/Lib/notifications';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';

export default function CreateClient({ auth, categories }) {
    const { data, setData, post, errors } = useForm({
        name: '',
        email: '',
        address: '',
        phone: '',
        image: '',
        password:'',
        category_ids: [],
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('clients.store'), {
            onSuccess: () => {
                toastSuccess('Client created successfully');
            },
            onError: () => {
                toastError('Error creating client');
            },
        });
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
            header={<h2 className="font-semibold text-xl text-white leading-tight">Add Client</h2>}
        >
            <Head title="Add Client" />

            <div className="py-12 flex justify-center">
                <form onSubmit={handleSubmit} className="w-full max-w-lg bg-gray-800 p-6 rounded-lg shadow-md">
                    <div className="mb-4">
                        <InputLabel forInput="name" value="Name" className='text-white' />
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
                        <InputLabel forInput="email" value="Email" className='text-white' />
                        <TextInput
                            id="email"
                            type="email"
                            value={data.email}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('email', e.target.value)}
                        />
                        {errors.email && <div className="text-red-600 mt-2">{errors.email}</div>}
                    </div>
                    <div className="mb-4">
                        <InputLabel forInput="password" value="Password" className='text-white' />
                        <TextInput
                            id="password"
                            type="password"
                            value={data.password}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('password', e.target.value)}
                        />
                        {errors.password && <div className="text-red-600 mt-2">{errors.password}</div>}
                    </div>

                    <div className="mb-4">
                        <InputLabel forInput="address" value="Address" className='text-white' />
                        <TextInput
                            id="address"
                            type="text"
                            value={data.address}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('address', e.target.value)}
                        />
                        {errors.address && <div className="text-red-600 mt-2">{errors.address}</div>}
                    </div>

                    <div className="mb-4">
                        <InputLabel forInput="phone" value="Phone" className='text-white' />
                        <TextInput
                            id="phone"
                            type="text"
                            value={data.phone}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('phone', e.target.value)}
                        />
                        {errors.phone && <div className="text-red-600 mt-2">{errors.phone}</div>}
                    </div>

                    <div className="mb-4">
                        <InputLabel forInput="image" value="Image URL" className='text-white' />
                        <TextInput
                            id="image"
                            type="text"
                            value={data.image}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('image', e.target.value)}
                        />
                        {errors.image && <div className="text-red-600 mt-2">{errors.image}</div>}
                    </div>

                    <div className="mb-4">
                        <InputLabel forInput="category_ids" value="Categories" className='text-white' />
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

                    <div className="flex justify-end">
                        <PrimaryButton className="ml-4">Add Client</PrimaryButton>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
