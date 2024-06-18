import DangerButton from "@/Components/DangerButton";
import PrimaryButton from "@/Components/PrimaryButton";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { toastError, toastSuccess } from "@/Lib/notifications";
import { Head, Link, router, useForm } from "@inertiajs/react";

export default function Dashboard({ auth, clients }) {
    const {
        data,
        setData,
        delete: destroy,
    } = useForm({
        id: "",
    });

    const handleDelete = (clientId) => {
        setData({ id: clientId });
        if (confirm("Are you sure you want to delete this client?")) {
            destroy(route("clients.destroy", clientId), {
                preserveScroll: true,
                onSuccess: () => {
                    toastSuccess("Client deleted successfully");
                    router.reload();
                },
                onError: () => {
                    toastError("Failed to delete client");
                },
            });
        }
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-white leading-tight">
                    Clients
                </h2>
            }
        >
            <Head title="Clients" />

            <div className="py-12 flex flex-col justify-center items-center gap-4">
                {auth.user.role === "admin" && (
                    <Link href={route("clients.create")}>
                        <PrimaryButton
                            className="w-34"
                            style={{
                                backgroundColor: "#4f46e5",
                                color: "white",
                            }}
                        >
                            + Add Client
                        </PrimaryButton>
                    </Link>
                )}
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-center gap-4 flex-wrap">
                    {clients.length > 0 ? (
                        clients.map((client) => (
                            <div
                                className="bg-white shadow-sm rounded-lg w-72 h-96 pt-8"
                                key={client.id}
                            >
                                <div
                                    className="w-full h-40 rounded-t-lg bg-contain bg-no-repeat bg-center mt-3"
                                    style={{
                                        backgroundImage: `url(${client.image})`,
                                    }}
                                ></div>
                                <div className="flex flex-col items-center px-2 py-4">
                                    <h2 className="text-center text-lg font-bold">
                                        {client.user.name}
                                    </h2>
                                    <h4 className="text-center">
                                        {client.address}
                                    </h4>
                                    <h4 className="text-center">
                                        {client.user.email}
                                    </h4>
                                    <h4 className="text-center">
                                        {client.phone}
                                    </h4>
                                </div>

                                <div className="flex justify-center items-center gap-4 w-72">
                                    <Link
                                        href={route(
                                            "clients.edit",
                                            client.id
                                        )}
                                    >
                                        <PrimaryButton className="w-34">
                                            Edit
                                        </PrimaryButton>
                                    </Link>
                                    <DangerButton
                                        className="w-34"
                                        onClick={() => handleDelete(client.id)}
                                    >
                                        Remove
                                    </DangerButton>
                                </div>
                            </div>
                        ))
                    ) : (
                        <h2 className="text-center text-2xl">
                            No clients found
                        </h2>
                    )}
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
