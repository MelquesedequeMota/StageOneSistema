<?php
namespace App\Http\Middleware;
use App\Models\Empresa;
use App\Support\Controller\TenantConnector;
use Closure;
class Tenant {
    use TenantConnector;
    /**
     * @var Empresa
     */
    protected $Empresa;
    /**
     * Tenant constructor.
     * @param Empresa $empresa
     */
    public function __construct(empresa $empresa) {
        $this->empresa = $empresa;
    }
    /**
     * Trata a requisição
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (($request->session()->get('tenant')) === null)
            return redirect()->route('home')->withErrors(['error' => __('Você não selecionou nenhum cliente.')]);
        // Busca a empresa pelo id armazenado na sessão
        $empresa = $this->empresa->find($request->session()->get('tenant'));
        // Conecta no banco escolhido e colocar a variavel $empresa na sessão
        $this->reconnect($empresa);
        $request->session()->put('empresa', $empresa);
        return $next($request);
    }
}