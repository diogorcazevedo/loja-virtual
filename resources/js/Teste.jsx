import Store from '@/Layouts/Store';
import {Head, Link, usePage} from '@inertiajs/inertia-react';
import React from 'react';

export default function Teste({destaques }) {

    const {auth} = usePage().props
    const { errors } = usePage().props

  return (
    <Store user={auth.user} errors={errors}>


      <div className="pt-28">
        {destaques.map((destaque) => (
          <div key={destaque.id} className="mb-16">
            <Link href={route('store.collection', { collection: destaque.slug })}>
              <div aria-hidden="true" className=" w-full">
                <img
                  src={"/storage/images/" + destaque.images[0]?.id + '.' + destaque.images[0]?.extension}
                  alt=""
                  className="w-full object-center object-cover"
                />
                <h1 className="ml-4 mt-4 mb-12 text-3xl tracking-wide">COLEÇÃO {destaque.name}</h1>
              </div>
            </Link>
          </div>
        ))}
      </div>

    </Store>
  );
}
