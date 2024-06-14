import DangerButton from '@/Components/DangerButton';
import PrimaryButton from '@/Components/PrimaryButton';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';


export default function Dashboard({ auth, products }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-white leading-tight">Products</h2>}
        >
            <Head title="Products" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-center gap-4 flex-wrap">
            
                    { products.length > 0 ? products.map((product) => (
                        <div className="bg-white  shadow-sm rounded-lg w-72 h-96 pt-12">
                        <div className="w-full h-40 rounded-t-lg bg-contain bg-no-repeat bg-center mt-3" style={{backgroundImage: `url(${product.image})`}}></div>
                       <div className='flex flex-col items-center px-2 py-4 '>
                       <h2 className="text-center text-lg font-bold">{product.name}</h2>
                        <div className="flex justify-between items-center">
                            Categories
                        </div>
                        <h4 className="text-center">{product.price}</h4>
                       </div>

                    <div className="flex justify-center items-center gap-4 w-72">
                    <PrimaryButton className="w-34">Edit</PrimaryButton>
                    <DangerButton className="w-34">Remove</DangerButton>
                    </div>
                    </div> )) : 
                    <h2 className="text-center text-2xl">No products found</h2>
                    }
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
