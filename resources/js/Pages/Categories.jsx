import DangerButton from "@/Components/DangerButton";
import { FaEdit } from "react-icons/fa";
import PrimaryButton from "@/Components/PrimaryButton";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { MdDelete } from "react-icons/md";

export default function Dashboard({ auth, groups }) {
    console.log(groups);
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-white leading-tight">
                    Categories
                </h2>
            }
        >
            <Head title="Categories" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col  items-center justify-center px-4 gap-x-28 gap-4">
                    {groups.length > 0 ? (
                        groups.map((group) => 
                            <div key={group.id} className="bg-white w-full max-w-md rounded-lg  p-10 text-center flex flex-col gap-2">
                                <h2 className="text-2xl font-bold text-black mb-2">{group.name}</h2>
                            {group.categories.map((category) => (
                                
                                    <div className="flex items-center px-2  gap-y-2 justify-between">
                                    <span className="bg-gray-200 px-2 py-2 rounded-full text-sm text-bold
                                     text-white" style={{background: category.color}}>{category.name}</span>
                                    <div className="flex justify-end items-center gap-4 w-52">
                                        <PrimaryButton className="w-34">
                                            <FaEdit />
                                        </PrimaryButton>
                                        <DangerButton className="w-34">
                                            <MdDelete />
                                        </DangerButton>
                                    </div>
                                   
                                    </div>


                            ))}
                            </div>
                        )
                    ) : (
                        <h2 className="text-center text-2xl">
                            No categories found
                        </h2>
                    )}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
