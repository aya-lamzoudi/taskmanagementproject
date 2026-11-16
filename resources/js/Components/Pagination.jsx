import { Link } from "@inertiajs/react";


export default function Pagination({ links }){
    return(
        <nav className="text-center mt-4">
            {links.map( link =>(
              <Link  
              preserveScroll
              href={ link.url || ""}
              key={link.label}
              className={
                        "inline-block px-3 py-1 text-sm rounded border " +
                        (link.active
                            ? "bg-blue-600 text-white border-blue-600"
                            : !link.url
                                ? "text-gray-400 border-gray-200 cursor-not-allowed"
                                : "text-gray-700 border-gray-300 hover:bg-gray-100")
                    }
              dangerouslySetInnerHTML={{__html: link.label}}></Link>

            ))}

        </nav>
    );
}