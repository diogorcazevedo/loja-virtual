import {Dialog, Transition} from "@headlessui/react";
import {MenuIcon, SearchIcon, XIcon} from "@heroicons/react/outline";
import { Fragment, useState } from 'react'
import {Link} from "@inertiajs/inertia-react";

export default function MobileNavBar({navigation}) {

    const [mobileMenuOpen, setMobileMenuOpen] = useState(false)

console.log(mobileMenuOpen);

    return (
        <>

            {/* Mobile menu and search (lg-) */}
            <div className="flex-1 flex items-center lg:hidden ee">
                <button type="button" className=" -ml-2 p-2 text-dark" onClick={()=>setMobileMenuOpen(!mobileMenuOpen)}>
                    <span className="sr-only">Open menu</span>
                    <MenuIcon className="h-6 w-6" aria-hidden="true" />
                </button>

                {/* Search */}
                <a href="#" className="ml-2 p-2 text-dark">
                    <span className="sr-only">Search</span>
                    <SearchIcon className="w-6 h-6" aria-hidden="true" />
                </a>
            </div>

            {/* Logo (lg-) */}
            <a href="/" className="lg:hidden">
                <span className="sr-only">carla buaiz joias</span>
                <img
                    src="/img/logo.svg"
                     alt=""
                    className="h-20 w-auto"
                />
            </a>

            <Transition.Root show={mobileMenuOpen} as={Fragment}>
                <Dialog as="div" className="fixed inset-0 flex z-40 lg:hidden eeee" onClose={() => setMobileMenuOpen(true)}>
                    <Transition.Child
                        as={Fragment}
                        enter="transition-opacity ease-linear duration-300"
                        enterFrom="opacity-0"
                        enterTo="opacity-100"
                        leave="transition-opacity ease-linear duration-300"
                        leaveFrom="opacity-100"
                        leaveTo="opacity-0"
                    >
                        <Dialog.Overlay className="fixed inset-0 bg-black bg-opacity-25" />
                    </Transition.Child>

                    <Transition.Child
                        as={Fragment}
                        enter="transition ease-in-out duration-300 transform"
                        enterFrom="-translate-x-full"
                        enterTo="translate-x-0"
                        leave="transition ease-in-out duration-300 transform"
                        leaveFrom="translate-x-0"
                        leaveTo="-translate-x-full"
                    >
                        <div className="relative max-w-xs w-full bg-white shadow-xl pb-12 flex flex-col overflow-y-auto">
                            <div className="px-4 pt-5 pb-2 flex">
                                <button
                                    type="button"
                                    className="-m-2 p-2 rounded-md inline-flex items-center justify-center text-gray-400"
                                    onClick={() => setMobileMenuOpen(false)}
                                >
                                    <span className="sr-only">Close menu</span>
                                    <XIcon className="h-6 w-6" aria-hidden="true" />
                                </button>
                            </div>

                            {/* Links */}

                            <div className="border-t border-gray-200 py-6 px-4 space-y-6">
                                {navigation.pages.map((page,index) => (
                                    <div key={index} className="flow-root">
                                        <Link href={page.href} className="-m-2 p-2 block font-medium text-gray-900">
                                            {page.name}
                                        </Link>
                                    </div>
                                ))}
                            </div>

                            <div className="border-t border-gray-200 py-6 px-4 space-y-6">
                                <div className="flow-root">
                                    <Link href={route('register')} className="-m-2 p-2 block font-medium text-gray-900">
                                        Criar conta
                                    </Link>
                                </div>
                                <div className="flow-root">
                                    <Link href={route('login')} className="-m-2 p-2 block font-medium text-gray-900">
                                        Login
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </Transition.Child>
                </Dialog>
            </Transition.Root>

        </>

    );
}
