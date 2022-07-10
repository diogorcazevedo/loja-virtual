import { Popover } from '@headlessui/react'
import { ShoppingBagIcon } from '@heroicons/react/outline'
import { Link } from '@inertiajs/inertia-react';
import MobileNavBar from "@/Layouts/Store/MobileNavBar";


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

  return (
    <div className="bg-white">
      {/* Mobile menu */}

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
                        <span className="sr-only">carla buaiz</span>
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

                      <MobileNavBar navigation={navigation}/>

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
