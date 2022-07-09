import {Dialog, Transition} from "@headlessui/react";
import {XIcon} from "@heroicons/react/outline";
import { Fragment, useState } from 'react'
import {Link} from "@inertiajs/inertia-react";

export default function MobileNavBar({navigation}) {
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false)
    return (
        <>
            <Transition.Root show={mobileMenuOpen} as={Fragment}>
                <Dialog as="div" className="fixed inset-0 flex z-40 lg:hidden" onClose={setMobileMenuOpen}>
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
                                    <a href="#" className="-m-2 p-2 block font-medium text-gray-900">
                                        Create an account
                                    </a>
                                </div>
                                <div className="flow-root">
                                    <a href="#" className="-m-2 p-2 block font-medium text-gray-900">
                                        Sign in
                                    </a>
                                </div>
                            </div>

                            <div className="border-t border-gray-200 py-6 px-4 space-y-6">
                                {/* Currency selector */}
                                <form>
                                    <div className="inline-block">
                                        <label htmlFor="mobile-currency" className="sr-only">
                                            Currency
                                        </label>
                                        <div className="-ml-2 group relative border-transparent rounded-md focus-within:ring-2 focus-within:ring-white">

                                            <div className="absolute right-0 inset-y-0 flex items-center pointer-events-none">
                                                <svg
                                                    aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 20 20"
                                                    className="w-5 h-5 text-gray-500"
                                                >
                                                    <path
                                                        stroke="currentColor"
                                                        strokeLinecap="round"
                                                        strokeLinejoin="round"
                                                        strokeWidth="1.5"
                                                        d="M6 8l4 4 4-4"
                                                    />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </Transition.Child>
                </Dialog>
            </Transition.Root>
        </>

    );
}
