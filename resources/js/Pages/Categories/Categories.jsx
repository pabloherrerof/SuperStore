import DangerButton from "@/Components/DangerButton";
import PrimaryButton from "@/Components/PrimaryButton";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { toastError, toastSuccess } from "@/Lib/notifications";
import { Head, Link, useForm } from "@inertiajs/react";
import { FaEdit } from "react-icons/fa";
import { MdDelete } from "react-icons/md";

export default function Categories({ auth, groups }) {
    const {
        data,
        setData,
        delete: destroy,
    } = useForm({
        id: "",
    });

    console.log(groups)

    const handleDelete = (categoryId) => {
        setData({ id: categoryId });
        if (confirm("Are you sure you want to delete this category?")) {
            destroy(route("categories.destroy", categoryId), {
                preserveScroll: true,
                onSuccess: () => {
                    toastSuccess("Category deleted successfully");
                },
                onError: () => {
                    toastError("Error deleting category");
                },
            });
        }
    };

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

            <div className="py-12 flex flex-col justify-center items-center gap-4">
                {auth.user.role === "admin" && (
                    <Link href={route("categories.create")}>
                        <PrimaryButton
                            className="w-34"
                            style={{
                                backgroundColor: "#4f46e5",
                                color: "white",
                            }}
                        >
                            + Add Category
                        </PrimaryButton>
                    </Link>
                )}
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col items-center justify-center gap-4 flex-wrap">
                    {groups.length > 0 ? (
                        groups.map((group) => (
                            <div
                                key={group.id}
                                className="bg-white w-full max-w-md rounded-lg p-10 text-center flex flex-col gap-2"
                            >
                                <h2 className="text-2xl font-bold text-black mb-2">
                                    {group.name}
                                </h2>
                                {group.categories.map((category) => (
                                    <div
                                        key={category.id}
                                        className="flex items-center px-2 gap-y-2 justify-between"
                                    >
                                        <span
                                            className="bg-gray-200 px-2 py-2 rounded-full text-sm text-bold text-white"
                                            style={{
                                                background: category.color,
                                            }}
                                        >
                                            {category.name}
                                        </span>
                                        <div className="flex justify-end items-center gap-4 w-52">
                                            {auth.user.role === "admin" && (
                                                <>
                                                    <Link
                                                        href={route(
                                                            "categories.edit",
                                                            category.id
                                                        )}
                                                    >
                                                        <PrimaryButton className="w-34">
                                                            <FaEdit />
                                                        </PrimaryButton>
                                                    </Link>
                                                    <DangerButton
                                                        className="w-34"
                                                        onClick={() =>
                                                            handleDelete(
                                                                category.id
                                                            )
                                                        }
                                                    >
                                                        <MdDelete />
                                                    </DangerButton>
                                                </>
                                            )}
                                        </div>
                                    </div>
                                ))}
                            </div>
                        ))
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
