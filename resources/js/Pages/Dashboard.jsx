import DangerButton from '@/Components/DangerButton';
import PrimaryButton from '@/Components/PrimaryButton';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { toastError, toastSuccess } from '@/Lib/notifications';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Dashboard({ auth, products }) {
    const { data, setData, delete: destroy } = useForm({
        id: '',
    });

    const handleDelete = (productId) => {
        setData({ id: productId });
        if (confirm("Are you sure you want to delete this product?")) {
            destroy(route('products.destroy', productId), {
                preserveScroll: true,
                onSuccess: () => {
                    toastSuccess('Product deleted successfully');
                },
                onError: () => {
                    toastError('Error deleting product');
                }
            });
        }
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-white leading-tight">Products</h2>}
        >
            <Head title="Products" />

            <div className="py-12 flex flex-col justify-center items-center gap-4">
                {auth.user.role === "admin" && <Link href={route('products.create')}><PrimaryButton className="w-34" style={{backgroundColor: "#4f46e5", color: "white"}}>+ Add Product</PrimaryButton></Link>}
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-center gap-4 flex-wrap">
                    {products.length > 0 ? products.map((product) => (
                        <div className="bg-white shadow-sm rounded-lg w-72 h-96 pt-12" key={product.id}>
                            <div className="w-full h-40 rounded-t-lg bg-contain bg-no-repeat bg-center mt-3" style={{ backgroundImage: `url(${product.image})` }}></div>
                            <div className='flex flex-col items-center px-2 py-4 '>
                                <h2 className="text-center text-lg font-bold">{product.name}</h2>
                                <div className="flex gap-2 items-center flex-wrap">
                                    {product.category.map((category) => (
                                        <span className="bg-gray-200 px-2 py-1 rounded-full text-sm text-white" style={{ background: category.color }} key={category.name}>{category.name}</span>
                                    ))}
                                </div>
                                <h4 className="text-center">{product.price}</h4>
                            </div>

                            {auth.user.role === "admin" && <div className="flex justify-center items-center gap-4 w-72">
                            <Link href={route('products.edit', product.id)}><PrimaryButton className="w-34">Edit</PrimaryButton></Link>
                                <DangerButton className="w-34" onClick={() => handleDelete(product.id)}>Remove</DangerButton>
                            </div>}
                        </div>
                    )) : 
                    <h2 className="text-center text-2xl">No products found</h2>}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
