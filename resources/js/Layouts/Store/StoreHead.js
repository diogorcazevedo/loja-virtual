import { Fragment, useState } from 'react'
import { Dialog, Popover, Transition } from '@headlessui/react'
import { MenuIcon, SearchIcon, ShoppingBagIcon, XIcon } from '@heroicons/react/outline'
import { Link } from '@inertiajs/inertia-react';


const navigation = {
  pages: [
    { name: 'Coleções', href: route('store.collections') },
    { name: 'Brincos', href: route('store.category',{category:2}) },
    { name: 'Anéis', href: route('store.category',{category:1}) },
    { name: 'Colares', href: route('store.category',{category:3}) },
    { name: 'Clipping', href: '#' },
    { name: 'Endereços', href: '#' },
  ],
}



export default function Header({user}) {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false)

  return (
    <div className="bg-white">
      {/* Mobile menu */}
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
                    <a href={page.href} className="-m-2 p-2 block font-medium text-gray-900">
                      {page.name}
                    </a>
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

      {/* Hero section */}
      <div className="relative bg-white">

        {/* Navigation */}
        <header className="relative">
          <nav aria-label="Top" className='fixed top-0 z-50 left-0 right-0'>


            {/* Secondary navigation */}
            <div className="bg-white pt-6 pb-6">
              <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div>
                  <div className="h-16 flex items-center justify-between">
                    {/* Logo (lg+) */}
                    <div className="hidden lg:flex-1 lg:flex lg:items-center">
                      <a href="/">
                        <span className="sr-only">Workflow</span>
                        <img
                          className="h-28 w-auto"
                          src="/img/logo.svg"
                          alt="logo"
                        />
                      </a>
                    </div>

                    <div className="hidden h-full lg:flex">
                      {/* Flyout menus */}
                      <Popover.Group className="px-4 bottom-0 inset-x-0">
                        <div className="h-full flex justify-center space-x-8">


                          {navigation.pages.map((page,index) => (
                            <Link
                              key={index}
                              href={page.href}
                              className="flex items-center  font-light text-gray-700 hover:text-gray-400"
                            >
                              {page.name}
                            </Link>
                          ))}
                          <Link href={route('lojavirtual')} className=" p-2 text-gray-400 hover:text-gray-500 lg:hidden">
                            <span className="sr-only">loja Virtual</span>
                            {/*  <QuestionMarkCircleIcon class="w-6 h-6" aria-hidden="true" />  */}
                          </Link>
                          <Link href={route('lojavirtual')} className="hidden lg:block inline-flex place-self-center items-center px-2.5 py-1.5 border border-transparent  font-medium rounded text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Loja Virtual
                          </Link>
                        </div>
                      </Popover.Group>
                    </div>

                    {/* Mobile menu and search (lg-) */}
                    <div className="flex-1 flex items-center lg:hidden">
                      <button type="button" className="-ml-2 p-2 text-dark" onClick={() => setMobileMenuOpen(true)}>
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
                    <a href="#" className="lg:hidden">
                      <span className="sr-only">Workflow</span>
                      <img
                        src="/img/logo.svg"
                       // src="https://tailwindui.com/img/logos/workflow-mark.svg?color=white"
                        alt=""
                        className="h-20 w-auto"
                      />
                    </a>

                    <div className="flex-1 flex items-center justify-end">


                      <div className="flex items-center lg:ml-8">


                          {user ? (
                            <Link href={route('dashboard')} className="text-sm text-gray-700 underline hidden lg:block inline-flex">
                              Dashboard
                            </Link>
                          ) : (
                            <>
                              <Link href={route('login')} className="text-sm text-gray-700 underline hidden lg:block inline-flex">
                                Log in
                              </Link>

                              <Link href={route('register')} className="ml-4 text-sm text-gray-700 underline hidden lg:block inline-flex">
                                Register
                              </Link>
                            </>
                          )}

                        {/* Cart */}
                        <div className="ml-4 flow-root lg:ml-8">
                          <a href="#" className="group -m-2 p-2 flex items-center">
                            <ShoppingBagIcon className="flex-shrink-0 h-6 w-6 text-gray-700" aria-hidden="true" />
                            <span className="ml-2 text-sm font-medium text-dark">0</span>
                            <span className="sr-only">items in cart, view bag</span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </header>


      </div>

    </div>
  )
}
