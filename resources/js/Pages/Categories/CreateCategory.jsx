import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import PrimaryButton from '@/Components/PrimaryButton';
import { toastError, toastSuccess } from '@/Lib/notifications';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';

export default function CreateCategory({ auth, groups }) {
    const { data, setData, post, errors } = useForm({
        name: '',
        color: '',
        group_id: '',
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('categories.store'), {
            onSuccess: () => {
                toastSuccess('Category created successfully');
            },
            onError: () => {
                toastError('Error creating category');
            },
        });
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-white leading-tight">Add Category</h2>}
        >
            <Head title="Add Category" />

            <div className="py-12 flex justify-center">
                <form onSubmit={handleSubmit} className="w-full max-w-lg bg-gray-800 p-6 rounded-lg shadow-md">
                    <div className="mb-4">
                        <InputLabel forInput="name" value="Category Name" className='text-white' />
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
                        <InputLabel forInput="color" value="Color" className='text-white' />
                        <TextInput
                            id="color"
                            type="text"
                            value={data.color}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('color', e.target.value)}
                        />
                        {errors.color && <div className="text-red-600 mt-2">{errors.color}</div>}
                    </div>

                    <div className="mb-4">
                        <InputLabel forInput="group_id" value="Group" className='text-white' />
                        <select
                            id="group_id"
                            value={data.group_id}
                            className="mt-1 block w-full"
                            onChange={(e) => setData('group_id', e.target.value)}
                        >
                            <option value="">Select a group</option>
                            {groups.map((group) => (
                                <option key={group.id} value={group.id}>{group.name}</option>
                            ))}
                        </select>
                        {errors.group_id && <div className="text-red-600 mt-2">{errors.group_id}</div>}
                    </div>

                    <div className="flex justify-end">
                        <PrimaryButton className="ml-4">Add Category</PrimaryButton>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
}
