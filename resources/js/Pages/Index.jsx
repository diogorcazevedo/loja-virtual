import Store from '@/Layouts/Store';
import {Head, Link, usePage} from '@inertiajs/inertia-react';
import React from 'react';

export default function Index({destaques }) {

    const {auth} = usePage().props
    const { errors } = usePage().props

  return (
    <Store user={auth.user} errors={errors}>
      <Head title="Home" />

      <div className="pt-28">
        {destaques.map((destaque) => (
          <div key={destaque.id} className="mb-16">
            <Link href={route('store.collection', { collection: destaque.slug })}>
              <div aria-hidden="true" className=" w-full">
                <img
                  src={"https://carlabuaizjoias.s3.sa-east-1.amazonaws.com/"+destaque.images[0]?.path}
                  alt=""
                  className="w-full object-center object-cover"
                />
                <h1 className="ml-4 mt-4 mb-12 text-3xl tracking-wide">Colecões {destaque.name}</h1>
              </div>
            </Link>
          </div>
        ))}
      </div>

    </Store>
  );
}
