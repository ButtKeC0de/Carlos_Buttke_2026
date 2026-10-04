<?php

function ordenarPorHorario($agenda) {

    usort($agenda, function($a, $b) {
        $dataHoraA = $a['data'] . ' ' . $a['horario'];
        $dataHoraB = $b['data'] . ' ' . $b['horario'];
        return strcmp($dataHoraA, $dataHoraB);
    });
    return $agenda;
}


function contarPacientesUnicos($agenda) {
    $pacientes = [];
    foreach ($agenda as $consulta) {
        $pacientes[] = mb_strtolower($consulta['nome'], 'UTF-8');
    }

    return count(array_unique($pacientes));
}


function contarPorEspecialidade($agenda) {
    $especialidades = [];
    foreach ($agenda as $consulta) {
        $esp = $consulta['especialidade'];
        if (!isset($especialidades[$esp])) {
            $especialidades[$esp] = 0;
        }
        $especialidades[$esp]++;
    }
    return $especialidades;
}


function obterExtremosDoDia($agendaOrdenada) {
    if (empty($agendaOrdenada)) {
        return ['primeiro' => null, 'ultimo' => null];
    }
    
    return [
        'primeiro' => $agendaOrdenada[0],

        'ultimo' => end($agendaOrdenada) 
    ];

function pesquisarPaciente($agenda, $nomePesquisa) {
    if (empty(trim($nomePesquisa))) return [];
    
    $resultados = [];
    $nomePesquisaLower = mb_strtolower($nomePesquisa, 'UTF-8');
    
    foreach ($agenda as $consulta) {
        $nomeConsultaLower = mb_strtolower($consulta['nome'], 'UTF-8');

        if (mb_strpos($nomeConsultaLower, $nomePesquisaLower) !== false) {
            $resultados[] = $consulta;
        }
    }
    return $resultados;
}

function verificarHorariosDuplicados($agenda) {
    $horariosOcupados = [];
    
    foreach ($agenda as $consulta) {
        $chaveDataHora = $consulta['data'] . ' ' . $consulta['horario'];
        
        if (isset($horariosOcupados[$chaveDataHora])) {
            return true; 
        }
        $horariosOcupados[$chaveDataHora] = true;
    }
    return false; 
}

function organizarAgenda($agenda, $nomePesquisa = '') {

    
    $agendaOrdenada = ordenarPorHorario($agenda);
    $extremos = obterExtremosDoDia($agendaOrdenada);
    
    return [
        'total_consultas' => count($agenda),
        'pacientes_diferentes' => contarPacientesUnicos($agenda),
        'consultas_por_especialidade' => contarPorEspecialidade($agenda),
        'primeiro_atendimento' => $extremos['primeiro'],
        'ultimo_atendimento' => $extremos['ultimo'],
        'agenda_ordenada' => $agendaOrdenada,
        'pesquisa_paciente' => pesquisarPaciente($agenda, $nomePesquisa),
        'horarios_duplicados' => verificarHorariosDuplicados($agenda)
    ];
}


$consultas = [
    ['nome' => 'Ana Silva', 'especialidade' => 'Dermatologia', 'data' => '2026-10-05', 'horario' => '14:30'],
    ['nome' => 'Carlos Souza', 'especialidade' => 'Cardiologia', 'data' => '2026-10-05', 'horario' => '09:00'],
    ['nome' => 'Ana Silva', 'especialidade' => 'Nutrição', 'data' => '2026-10-05', 'horario' => '15:00'],
    ['nome' => 'Marcos Paulo', 'especialidade' => 'Cardiologia', 'data' => '2026-10-05', 'horario' => '10:15'],
    ['nome' => 'Juliana Lima', 'especialidade' => 'Dermatologia', 'data' => '2026-10-05', 'horario' => '09:00'], // Horário duplicado propositalmente com o Carlos
];

$relatorioAgenda = organizarAgenda($consultas, 'Ana');

echo "--- Relatório da Agenda ---\n";
echo "Total de Consultas: " . $relatorioAgenda['total_consultas'] . "\n";
echo "Pacientes Diferentes: " . $relatorioAgenda['pacientes_diferentes'] . "\n\n";

echo "Consultas por Especialidade:\n";
foreach ($relatorioAgenda['consultas_por_especialidade'] as $especialidade => $qtd) {
    echo "- $especialidade: $qtd\n";
}

echo "\nPrimeiro Atendimento do Dia: " . $relatorioAgenda['primeiro_atendimento']['horario'] . " (" . $relatorioAgenda['primeiro_atendimento']['nome'] . ")\n";
echo "Último Atendimento do Dia: " . $relatorioAgenda['ultimo_atendimento']['horario'] . " (" . $relatorioAgenda['ultimo_atendimento']['nome'] . ")\n";

echo "\nExistem horários em conflito (duplicados)? " . ($relatorioAgenda['horarios_duplicados'] ? 'SIM' : 'NÃO') . "\n";

echo "\nResultado da Pesquisa para o paciente informado:\n";
print_r($relatorioAgenda['pesquisa_paciente']);

?>